<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

use Osfrportal\OsfrportalLaravel\Data\Orion\TPersonData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TKeyData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TAccessLevelData;
use Osfrportal\OsfrportalLaravel\Data\Orion\TEntryPointData;
use Osfrportal\OsfrportalLaravel\Models\SfrPersOrion;
use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionCards;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionAccessLevels;
use Osfrportal\OsfrportalLaravel\Models\SfrOrionEntryPoints;

use Osfrportal\OsfrportalLaravel\Jobs\SfrOrionSyncAccessLevelsJob;
use Osfrportal\OsfrportalLaravel\Jobs\SfrOrionSyncEntryPointsJob;
use Osfrportal\OsfrportalLaravel\Jobs\SfrOrionSyncPersonsJob;
use Osfrportal\OsfrportalLaravel\Jobs\SfrOrionSyncCardsJob;
use Osfrportal\OsfrportalLaravel\Jobs\SfrOrionSyncDeletedCardsJob;

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Notification;
use Osfrportal\OsfrportalLaravel\Notifications\OrionSync;

class SFROrionController extends Controller
{
    protected $soapWrapper;
    protected $orionSoapURL;
    protected $dateformat = 'c';

    private $rfidKeysUserArray;
    private $orionPersonCards;

    protected $usersToNotify;

    public function __construct()
    {
        parent::__construct();
        $this->soapWrapper = new SoapWrapper;
        $this->orionSoapURL = config('osfrportal.orion_soap_url');
        $this->soapWrapper->add('IOrionPro', function ($service) {
            $service
                ->wsdl($this->orionSoapURL)
                ->trace(false)
                ->cache(WSDL_CACHE_NONE);
        });
        $this->usersToNotify = SfrUser::permission('system-notifications')->get();
    }
    public function test()
    {
        //Auth::user()->givePermissionTo('system-notifications');
        //dump($this->usersToNotify);
        //$this->syncEntryPointsToDB();
        //$this->syncAccessLevelsToDB();
        //$this->syncAllOrionPersonsToDB();

    }
    public function addOrionPerson()
    {
        $personData = TPersonData::from([
            'LastName' => 'LastName',
            'FirstName' => 'FirstName',
            'MiddleName' => 'MiddleName',
            'BirthDate' => '30.12.1899',
            'CompanyId' => -1,
            'DepartmentId' => -1,
            'PositionId' => -1,
            'TabNum' => '123123123',
            'AccessLevelId' => 0,
            'Status' => 5,
            'Itn' => '123123123',
            'DocumentIssueDate' => '1899-12-30T00:00:00.000+03:00',
            'DocumentEndingDate' => '1899-12-30T00:00:00.000+03:00',
            'ArchivingTimeStamp' => '1899-12-30T00:00:00.000+03:00',
            'ChangeTime' => Carbon::now()->format('Y-m-d\TH:i:s.000O'),
        ]);
        $pDataArr = $personData->toArray();
        dump($pDataArr);

        $orionAddPerson = $this->soapWrapper->call('IOrionPro.AddPerson', ['personData' => $pDataArr]);
        if ($orionAddPerson->Success && is_null($orionAddPerson->ServiceError)) {
            $orionAddPersonResult = $orionAddPerson->OperationResult;
            dump($orionAddPersonResult);
        } else {
            dump($orionAddPerson->ServiceError);
        }

    }
    public function syncEntryPointsToDB()
    {
        $orionEntryPointsCount = $this->soapWrapper->call('IOrionPro.GetEntryPointsCount', []);
        if ($orionEntryPointsCount->Success && is_null($orionEntryPointsCount->ServiceError)) {
            $orionEntryPointsCountResult = $orionEntryPointsCount->OperationResult;
            $offset = 0;
            $count = 25;
            $jobsBatch = [];
            do {
                $orionEntryPoints = $this->soapWrapper->call('IOrionPro.GetEntryPoints', ['offset' => $offset, 'count' => $count]);
                if ($orionEntryPoints->Success && is_null($orionEntryPoints->ServiceError)) {
                    $orionEntryPointsResult = $orionEntryPoints->OperationResult;
                    foreach ($orionEntryPointsResult as $orionEntryPoint) {
                        $entryPointData = TEntryPointData::from($orionEntryPoint);
                        $jobsBatch[] = new SfrOrionSyncEntryPointsJob($entryPointData);
                    }
                } else {
                    dump($orionEntryPoints->ServiceError);
                }

                $orionEntryPointsCountResult = $orionEntryPointsCountResult - $count;
                $offset = $offset + $count;
            } while ($orionEntryPointsCountResult > 0);
            Bus::batch($jobsBatch)->then(function (Batch $batch) {
                Notification::send($this->usersToNotify, new OrionSync('Синхронизация точек доступа ОрионПРО завершена'));
            })->name('Import SKUD Entry Points')->onQueue('skud')->dispatch();
        } else {
            dump($orionEntryPointsCount->ServiceError);
        }
        //dump('Done syncEntryPointsToDB');
    }

    public function syncAccessLevelsToDB()
    {
        $orionAccessLevelsCount = $this->soapWrapper->call('IOrionPro.GetAccessLevelsCount', []);
        if ($orionAccessLevelsCount->Success && is_null($orionAccessLevelsCount->ServiceError)) {
            $orionAccessLevelsCountResult = $orionAccessLevelsCount->OperationResult;

            $offset = 0;
            $count = 20;
            $jobsBatch = [];
            do {
                $orionAccessLevels = $this->soapWrapper->call('IOrionPro.GetAccessLevels', ['offset' => $offset, 'count' => $count]);
                if ($orionAccessLevels->Success && is_null($orionAccessLevels->ServiceError)) {
                    $orionAccessLevelsResult = $orionAccessLevels->OperationResult;
                    foreach ($orionAccessLevelsResult as $orionAccessLevel) {
                        $accessLevelData = TAccessLevelData::from($orionAccessLevel);
                        $jobsBatch[] = new SfrOrionSyncAccessLevelsJob($accessLevelData);
                    }
                } else {
                    dump($orionAccessLevels->ServiceError);
                }

                $orionAccessLevelsCountResult = $orionAccessLevelsCountResult - $count;
                $offset = $offset + $count;
            } while ($orionAccessLevelsCountResult > 0);
            Bus::batch($jobsBatch)->then(function (Batch $batch) {
                Notification::send($this->usersToNotify, new OrionSync('Синхронизация уровней доступа ОрионПРО завершена'));
            })->name('Import SKUD Access Levels')->onQueue('skud')->dispatch();
        } else {
            dump($orionAccessLevelsCount->ServiceError);
        }
        //dump('Done syncAccessLevelsToDB');
    }

    public function syncAllOrionPersonsToDB()
    {
        $jobsBatch = [];
        $orionPersons = $this->soapWrapper->call('IOrionPro.GetPersons', ['withoutPhoto' => true]);
        if ($orionPersons->Success && is_null($orionPersons->ServiceError)) {
            $orionPersonsResult = (array) $orionPersons->OperationResult;
            //Получаем информацию по каждому работнику и пишем в базу
            foreach ($orionPersonsResult as $orionPerson) {
                $person = SfrPerson::where('pinn', $orionPerson->TabNum)->first();
                $personData = TPersonData::from($orionPerson);
                if (!is_null($person)) {
                    $pid = $person->getPid();
                } else {
                    $pid = null;
                }
                $jobsPersonBatch = [];
                $jobsPersonBatch[] = new SfrOrionSyncPersonsJob($personData, $orionPerson->Id, $pid);
                $orionPersonKeys = $this->soapWrapper->call('IOrionPro.GetPersonPassList', ['personData' => $personData]);
                if ($orionPersonKeys->Success && is_null($orionPersonKeys->ServiceError)) {
                    $orionPersonKeysResult = (array) $orionPersonKeys->OperationResult;
                    $this->orionPersonCards = collect();
                    //Получаем информацию по каждому ключу и пишем в базу
                    foreach ($orionPersonKeysResult as $orionPersonKey) {
                        $orionKeyDataRequest = $this->soapWrapper->call('IOrionPro.GetKeyData', ['CardNo' => $orionPersonKey]);
                        if ($orionKeyDataRequest->Success && is_null($orionKeyDataRequest->ServiceError)) {
                            $orionKeyDataResult = (array) $orionKeyDataRequest->OperationResult;
                            $keyData = TKeyData::from($orionKeyDataResult);
                            $orionPersId = $orionPerson->Id;
                            $keyId = $keyData->Id;
                            $accessLevelId = $keyData->AccessLevelId;
                            $this->orionPersonCards->push($orionPersonKey);

                            if ($accessLevelId !== 0) {
                                $jobsPersonBatch[] = new SfrOrionSyncCardsJob($keyData, $orionPersId, $keyId, $accessLevelId);
                            } else {
                                dump($personData);
                                dump($orionPersonKey);
                                dump($orionKeyDataResult);
                                dump($keyData);
                            }
                        } else {
                            dump($orionKeyDataRequest->ServiceError);
                        }
                    }
                } else {
                    dump($orionPersonKeys->ServiceError);
                }
                $jobsPersonBatch[] = new SfrOrionSyncDeletedCardsJob($pid, $this->orionPersonCards);
                $jobsBatch[] = $jobsPersonBatch;
            }
            Bus::batch($jobsBatch)->then(function (Batch $batch) {
                Notification::send($this->usersToNotify, new OrionSync('Синхронизация работников и карт доступа ОрионПРО завершена'));
            })->name('Import SKUD Persons with Cards')->onQueue('skud')->dispatch();
        } else {
            dump($orionPersons->ServiceError);
        }
        //dump('Done syncAllOrionPersonsToDB');
    }
}
