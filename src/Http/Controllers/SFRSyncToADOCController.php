<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Osfrportal\OsfrportalLaravel\Actions\SFRPersonActions;
use Osfrportal\OsfrportalLaravel\Data\SFRPhoneContactData;

class SFRSyncToADOCController extends Controller
{
    public $adoc_connection;

    public function synctoadoc(bool $from_command = false)
    {
        if ($from_command) {
            $this->adoc_connection = DB::connection('ADOCsqlsrv');
            $sfr_actions = new SFRPersonActions;
            $persons_all = $sfr_actions->SFRPersonsALL();
            $persons_all->each(function ($item, $key) {
                $aname = '';
                $unitname = '';
                $etabnumber = '';
                //contactdata
                $address = '';
                $room = '';

                $unitname = $item->getUnit();
                $aname = $item->getAppointment();
                $etabnumber = $item->getTabNum();
                $fullname = $item->getFullName();

                $snils = $item->getSNILS();
                if (!is_null($snils)) {
                    $update_pid_adoc_query = "UPDATE [ADOC].[dbo].[tblSsotr] SET [id_2] = ?, [id_1] = ?, [fam] = ?, [im] = ?, [ot] = ?, [Field10] = ?, [otd] = ?, [pos] = ? WHERE [pid] = ?";

                    $updated_count = $this->adoc_connection->update($update_pid_adoc_query, [$etabnumber, $snils, $item->psurname, $item->pname, $item->pmiddlename, $fullname, $unitname, $aname, $item->pid]);
                    if ($updated_count < 1) {
                        $insert_adoc_query = "INSERT INTO [dbo].[tblSsotr] ([id_2], [id_1], [Field10], [fam], [im], [ot], [pid], [otd], [pos]) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $values_insert = [$etabnumber, $snils, $fullname, $item->psurname, $item->pname, $item->pmiddlename, $item->pid, $unitname, $aname];
                        $this->adoc_connection->insert($insert_adoc_query, $values_insert);
                    }
                    if ($item->SfrPersonContacts()->count() > 0) {
                        //$contactdata_array = json_decode($item->SfrPersonContacts->contactdata);
                        $contactdata_array = SFRPhoneContactData::from($item->getPersonContactData());

                        $address = $contactdata_array->address;
                        $room = $contactdata_array->room;
                        if (empty($room)) {
                            $room = '-';
                        }
                        if (empty($address)) {
                            $address = '-';
                        }
                        $update_contactdata_query = "UPDATE [ADOC].[dbo].[tblContactInfo] SET [cifio] = ?, [ciaddress] = ?, [ciroom] = ?  WHERE [pid] = ?";
                        $updated_contactdata_count = $this->adoc_connection->update($update_contactdata_query, [$fullname, $address, $room, $item->pid]);
                        //$update_contactdata_query = "UPDATE [ADOC].[dbo].[tblContactInfo] SET [pid] = ?, [ciaddress] = ?, [ciroom] = ?  WHERE [cifio] = ?";
                        //$updated_contactdata_count = $this->adoc_connection->update($update_contactdata_query, [$item->pid, $address, $room, $fullname]);
                        if ($updated_contactdata_count < 1) {
                            $insert_contactdata_query = "INSERT INTO [dbo].[tblContactInfo] ([cifio], [ciaddress], [ciroom], [pid]) VALUES (?, ?, ?, ?)";
                            $values_contactdata_insert = [$fullname, $address, $room, $item->pid];
                            $this->adoc_connection->insert($insert_contactdata_query, $values_contactdata_insert);
                        }
                    }
                }
            });
        }
    }
}
