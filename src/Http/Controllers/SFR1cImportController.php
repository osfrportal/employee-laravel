<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Osfrportal\OsfrportalLaravel\Enums\AbsenceTypesEnum;
use Osfrportal\OsfrportalLaravel\Enums\LogActionsEnum;

use Osfrportal\OsfrportalLaravel\Models\SfrPerson;
use Osfrportal\OsfrportalLaravel\Models\SfrUser;
use Osfrportal\OsfrportalLaravel\Models\SfrPersonAbsence;

use Osfrportal\OsfrportalLaravel\Imports\SFRAbsencesImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRVacationsImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRDekretsImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRDepartmentsImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRPersonsImport;
use Osfrportal\OsfrportalLaravel\Imports\SFRPersonsMovementsImport;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Notification;
use Osfrportal\OsfrportalLaravel\Notifications\SFR1cSync;

use Carbon\Carbon;

use Osfrportal\OsfrportalLaravel\Actions\LogAddAction;

class SFR1cImportController extends Controller
{
    private $now_date_for_import;
    private $absence_file_name;
    private $vacation_file_name;
    private $dekret_file_name;
    private $otdel_file_name;
    private $pd_file_name;
    private $movements_file_name;

    private $persons_from_csv;

    protected $usersToNotify;

    public function __construct()
    {
        parent::__construct();
        $this->now_date_for_import = Carbon::now(config('app.timezone', 'Europe/Moscow'))->format('Y-m-d');
        //$this->now_date_for_import = '2023-08-23';
        $this->absence_file_name = sprintf('otsutstvie_058 (TXT) %s.txt', $this->now_date_for_import);
        $this->vacation_file_name = sprintf('vacation_058 (TXT) %s.txt', $this->now_date_for_import);
        $this->dekret_file_name = sprintf('dekret_058 (TXT) %s.txt', $this->now_date_for_import);
        $this->otdel_file_name = sprintf('otdel_058 (TXT) %s.txt', $this->now_date_for_import);
        $this->pd_file_name = sprintf('pd_058 (TXT) %s.txt', $this->now_date_for_import);
        $this->movements_file_name = sprintf('kadry_058 (TXT) %s.txt', $this->now_date_for_import);

        $this->usersToNotify = SfrUser::permission('system-notifications')->get();
    }

    private function SFRFileMergeFirstTwoLinesToOne($import_file_name)
    {
        if (Storage::disk('ftp1c')->exists($import_file_name)) {
            Storage::put($import_file_name, Storage::disk('ftp1c')->get($import_file_name));
            $file_contents = file(Storage::path($import_file_name));
            Storage::delete($import_file_name);
            $file_header = rtrim($file_contents[0]);
            $file_header .= ltrim($file_contents[1]);
            $file_contents[1] = $file_header;
            array_splice($file_contents, 0, 1);
            return implode($file_contents);
        } else {
            return '';
        }
    }
    /**
     * Импорт файла отсутствий
     * @param mixed $command_load
     * @return void
     */
    public function SFRAbsenceImportFromCSV($command_load = false)
    {
        $save_file_name = 'tmp_absence.txt';

        if (Storage::disk('ftp1c')->exists($this->absence_file_name)) {
            $import_file_size = Storage::disk('ftp1c')->size($this->absence_file_name);
            $logContext = [
                'file_name' => $this->absence_file_name,
                'import_file_size' => $import_file_size,
            ];
            LogAddAction::run(LogActionsEnum::LOG_IMPORT_ABSENCE(), 'Старт импорта файла отсутствий ({file_name}, размер: {import_file_size})', $logContext);

            if ((Storage::disk('ftp1c')->exists($this->absence_file_name)) && ($import_file_size > 0)) {
                Storage::put($save_file_name, $this->SFRFileMergeFirstTwoLinesToOne($this->absence_file_name));
                $import = new SFRAbsencesImport();
                $import->import($save_file_name);
                foreach ($import->failures() as $failure) {
                    $fval = $failure->values(); // The values of the row that has failed.
                    $log_context = [
                        'failure_errors' => $failure->errors(),
                        'failure_attribute' => $failure->attribute(),
                        'failure_row' => $failure->row(),
                        'failure_inn' => $fval['sotrudnikfiziceskoe_licoinn'],
                    ];
                    Log::warning('Ошибка обработки строки в файле импорта', $log_context);
                }
                Storage::delete($save_file_name);
            } else {
                if ($import_file_size == 0) {
                    Log::error('Размер файла импорта равен нулю!', ['import_file_size' => $import_file_size]);
                } else {
                    Log::error('Не найден файл импорта');
                }
            }
            LogAddAction::run(LogActionsEnum::LOG_IMPORT_ABSENCE(), 'Конец импорта файла отсутствий ({file_name}, размер: {import_file_size})', $logContext);

            //Log::info('Конец импорта отсутствий', ['import_file_size' => $import_file_size]);
            Notification::send($this->usersToNotify, new SFR1cSync('Импорт файла отсутствий завершен'));
        } else {
            Log::error('Не найден файл импорта отсутствий');
            Notification::send($this->usersToNotify, new SFR1cSync('ОШИБКА! Не найден файл импорта отсутствий'));
        }
    }

    /**
     * Импорт отпусков
     * @param mixed $command_load
     * @return void
     */
    public function SFRVacationsImportFromCSV($command_load = false)
    {
        $save_file_name = 'tmp_vacation.txt';

        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_VACATION(),
            'file_name' => $this->vacation_file_name,
        ]);
        if (Storage::disk('ftp1c')->exists($this->vacation_file_name)) {
            $import_file_size = Storage::disk('ftp1c')->size($this->vacation_file_name);
            Log::info('Старт импорта отпусков', ['import_file_size' => $import_file_size]);
            if ((Storage::disk('ftp1c')->exists($this->vacation_file_name)) && ($import_file_size > 0)) {
                Storage::put($save_file_name, Storage::disk('ftp1c')->get($this->vacation_file_name));
                $import = new SFRVacationsImport();
                $import->import($save_file_name);
                foreach ($import->failures() as $failure) {
                    $fval = $failure->values(); // The values of the row that has failed.
                    $log_context = [
                        'failure_errors' => $failure->errors(),
                        'failure_attribute' => $failure->attribute(),
                        'failure_row' => $failure->row(),
                        'failure_inn' => $fval['sotrudnikfiziceskoe_licoinn'],
                    ];
                    Log::warning('Ошибка обработки строки в файле импорта', $log_context);
                }
                Storage::delete($save_file_name);
            } else {
                if ($import_file_size == 0) {
                    Log::error('Размер файла импорта равен нулю!', ['import_file_size' => $import_file_size]);
                } else {
                    Log::error('Не найден файл импорта');
                }
            }
            Log::info('Конец импорта отпусков', ['import_file_size' => $import_file_size]);
            Notification::send($this->usersToNotify, new SFR1cSync('Импорт файла отпусков завершен'));
        } else {
            Log::error('Не найден файл импорта отпусков');
            Notification::send($this->usersToNotify, new SFR1cSync('ОШИБКА! Не найден файл импорта отпусков'));
        }
    }

    /**
     * Импорт декретных отпусков
     * @param mixed $command_load
     * @return void
     */
    public function SFRDekretImportFromCSV($command_load = false)
    {
        $save_file_name = 'tmp_dekret.txt';

        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_ABSENCE(),
            'file_name' => $this->dekret_file_name,
        ]);
        if (Storage::disk('ftp1c')->exists($this->dekret_file_name)) {
            $import_file_size = Storage::disk('ftp1c')->size($this->dekret_file_name);
            Log::info('Старт импорта декретных отпусков', ['import_file_size' => $import_file_size]);
            if ((Storage::disk('ftp1c')->exists($this->dekret_file_name)) && ($import_file_size > 0)) {
                Storage::put($save_file_name, $this->SFRFileMergeFirstTwoLinesToOne($this->dekret_file_name));
                $import = new SFRDekretsImport();
                $import->import($save_file_name);
                foreach ($import->failures() as $failure) {
                    $fval = $failure->values(); // The values of the row that has failed.
                    $log_context = [
                        'failure_errors' => $failure->errors(),
                        'failure_attribute' => $failure->attribute(),
                        'failure_row' => $failure->row(),
                        'failure_inn' => $fval['sotrudnikfiziceskoe_licoinn'],
                    ];
                    Log::warning('Ошибка обработки строки в файле импорта', $log_context);
                }
                Storage::delete($save_file_name);
            } else {
                if ($import_file_size == 0) {
                    Log::error('Размер файла импорта равен нулю!', ['import_file_size' => $import_file_size]);
                } else {
                    Log::error('Не найден файл импорта');
                }
            }
            Log::info('Конец импорта декретных отпусков', ['import_file_size' => $import_file_size]);
            Notification::send($this->usersToNotify, new SFR1cSync('Импорт файла декретных отпусков завершен'));
        } else {
            Log::error('Не найден файл импорта декретных отпусков');
            Notification::send($this->usersToNotify, new SFR1cSync('ОШИБКА! Не найден файл импорта декретных отпусков'));

        }

    }
    /**
     * Импорт должностей работника и подразделений
     * @param mixed $command_load
     * @return void
     */
    public function SFRDepatmentsImportFromCSV($command_load = false)
    {
        $save_file_name = 'tmp_otdel.txt';

        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_DEPARTMENTS(),
            'file_name' => $this->otdel_file_name,
        ]);
        if (Storage::disk('ftp1c')->exists($this->otdel_file_name)) {
            $import_file_size = Storage::disk('ftp1c')->size($this->otdel_file_name);
            Log::info('Старт импорта подразделений', ['import_file_size' => $import_file_size]);
            if ((Storage::disk('ftp1c')->exists($this->otdel_file_name)) && ($import_file_size > 0)) {
                Storage::put($save_file_name, Storage::disk('ftp1c')->get($this->otdel_file_name));
                if (Storage::exists($save_file_name)) {

                    $import = new SFRDepartmentsImport();
                    $import->import($save_file_name);
                    foreach ($import->failures() as $failure) {
                        $fval = $failure->values(); // The values of the row that has failed.
                        $log_context = [
                            'failure_errors' => $failure->errors(),
                            'failure_attribute' => $failure->attribute(),
                            'failure_row' => $failure->row(),
                            'failure_person' => $fval['sotrudnikfiziceskoe_lico'],
                        ];
                        Log::warning('Ошибка обработки строки в файле импорта', $log_context);
                    }

                    Storage::delete($save_file_name);
                } else {
                    Log::error('Ошибка записи временного файла импорта');
                }
            } else {
                if ($import_file_size == 0) {
                    Log::error('Размер файла импорта равен нулю!', ['import_file_size' => $import_file_size]);
                } else {
                    Log::error('Не найден файл импорта');
                }
            }
            Log::info('Конец импорта подразделений', ['import_file_size' => $import_file_size]);
            Notification::send($this->usersToNotify, new SFR1cSync('Импорт файла подразделений завершен'));
        } else {
            Log::error('Не найден файл импорта подразделений');
            Notification::send($this->usersToNotify, new SFR1cSync('ОШИБКА! Не найден файл импорта подразделений'));
        }
    }

    /**
     * Импорт физических лиц
     * @param mixed $command_load
     * @return void
     */
    public function SFRPersonsImportFromCSV($command_load = false)
    {
        $save_file_name = 'tmp_pd.txt';

        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_PD(),
            'file_name' => $this->pd_file_name,
        ]);
        if ((Storage::disk('ftp1c')->exists($this->pd_file_name))) {
            $import_file_size = Storage::disk('ftp1c')->size($this->pd_file_name);
            Log::info('Старт импорта физических лиц', ['import_file_size' => $import_file_size]);
            if ((Storage::disk('ftp1c')->exists($this->pd_file_name)) && ($import_file_size > 0)) {
                Storage::put($save_file_name, $this->SFRFileMergeFirstTwoLinesToOne($this->pd_file_name));
                if (Storage::exists($save_file_name)) {
                    $import = new SFRPersonsImport();
                    $import->import($save_file_name);
                    foreach ($import->failures() as $failure) {
                        $fval = $failure->values(); // The values of the row that has failed.
                        $log_context = [
                            'failure_errors' => $failure->errors(),
                            'failure_attribute' => $failure->attribute(),
                            'failure_row' => $failure->row(),
                            'failure_person' => $fval['sotrudnikfiziceskoe_lico'],
                        ];
                        Log::warning('Ошибка обработки строки в файле импорта', $log_context);
                    }
                    $this->SFREmployeeCheckFiredCSV($save_file_name);
                    Storage::delete($save_file_name);
                } else {
                    Log::error('Ошибка записи временного файла импорта');
                }
            } else {
                if ($import_file_size == 0) {
                    Log::error('Размер файла импорта равен нулю!', ['import_file_size' => $import_file_size]);
                } else {
                    Log::error('Не найден файл импорта');
                }
            }
            Log::info('Конец импорта физических лиц', ['import_file_size' => $import_file_size]);
            Notification::send($this->usersToNotify, new SFR1cSync('Конец импорта физических лиц'));
        } else {
            Log::error('Не найден файл импорта физических лиц');
            Notification::send($this->usersToNotify, new SFR1cSync('ОШИБКА! Не найден файл импорта физических лиц'));
        }

    }
    /**
     * Проверка увольнения работника.
     * Выбрать всех работников из БД и проверить на соответствие файлу pd
     * Если не найден в файле - удалить запись о занимаемой должности и подразделении.
     * @param mixed $pd_file
     * @return void
     */
    private function SFREmployeeCheckFiredCSV($pd_file)
    {
        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_PD(),
            'file_name' => $this->pd_file_name,
        ]);
        Log::info('Старт проверки уволенных работников');
        $this->persons_from_csv = (new SFRPersonsImport)->toCollection($pd_file)->first();
        $pfrpersons = SfrPerson::orderBy('psurname')->get();
        $pfrpersons->each(function ($item, $key) {
            if (($item->pinn != 'nan') && (!($this->persons_from_csv->firstWhere('inn', $item->pinn)))) {
                $logrectxt = sprintf("Удалена запись из таблицы должностей для работника pid: %s (%s %s %s) %s", $item->pid, $item->psurname, $item->pname, $item->pmiddlename, $item->pinn);
                $item->SfrPersonUnit()->detach();
                $item->SfrPersonAppointment()->detach();
                $item->SfrPersonContacts()->delete();
                $item->SfrPersonVacation()->delete();
                $item->SfrPersonDekret()->delete();
                $item->SfrPersonAbsence()->delete();
                $item->SfrPersonTabNum()->delete();
                //$item->SfrPersonCerts()->delete();
                $item->save();
                /**
                 * TODO: Добавить удаление
                 * доменных логинов
                 * карт ОрионПро
                 * ФЛ в ОрионПро
                 */
                //Log::info($logrectxt);
                //}
            }
        });
        Log::info('Конец проверки уволенных работников');
        Notification::send($this->usersToNotify, new SFR1cSync('Конец проверки уволенных работников'));
    }

    /**
     * Импорт кадровых перемещений
     * @param mixed $command_load
     * @return void
     */
    public function SFRPersonsMovementsImportFromCSV($command_load = false)
    {
        $save_file_name = 'tmp_kadry.txt';

        Log::withContext([
            'action' => LogActionsEnum::LOG_IMPORT_KADRY(),
            'file_name' => $this->movements_file_name,
        ]);
        if (Storage::disk('ftp1c')->exists($this->movements_file_name)) {
            $import_file_size = Storage::disk('ftp1c')->size($this->movements_file_name);
            Log::info('Старт импорта кадровых перемещений', ['import_file_size' => $import_file_size]);
            if ((Storage::disk('ftp1c')->exists($this->movements_file_name)) && ($import_file_size > 0)) {
                Storage::put($save_file_name, Storage::disk('ftp1c')->get($this->movements_file_name));
                $import = new SFRPersonsMovementsImport();
                $import->import($save_file_name);
                foreach ($import->failures() as $failure) {
                    $fval = $failure->values(); // The values of the row that has failed.
                    $log_context = [
                        'failure_errors' => $failure->errors(),
                        'failure_attribute' => $failure->attribute(),
                        'failure_row' => $failure->row(),
                        'failure_inn' => $fval['sotrudnikfiziceskoe_lico_snils'],
                    ];
                    Log::warning('Ошибка обработки строки в файле импорта', $log_context);
                }
                Storage::delete($save_file_name);
            } else {
                if ($import_file_size == 0) {
                    Log::error('Размер файла импорта равен нулю!', ['import_file_size' => $import_file_size]);
                } else {
                    Log::error('Не найден файл импорта');
                }
            }
            Log::info('Конец импорта кадровых перемещений', ['import_file_size' => $import_file_size]);
            Notification::send($this->usersToNotify, new SFR1cSync('Импорт файла кадровых перемещений завершен'));
        } else {
            Log::error('Не найден файл импорта кадровых перемещений');
            Notification::send($this->usersToNotify, new SFR1cSync('ОШИБКА! Не найден файл импорта кадровых перемещений'));
        }
    }
}
