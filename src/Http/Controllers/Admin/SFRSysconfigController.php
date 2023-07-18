<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers\Admin;

use Carbon\Carbon;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

use Osfrportal\OsfrportalLaravel\Models\SfrConfig;

class SFRSysconfigController extends Controller
{
    /**
     * ----------------------------
     * Основные функции
     * ----------------------------
     */

    public function saveConfigList(Request $request)
    {
        $inputToConfig = [
            'inputPortalName' => 'portal_name',
            'inputHsmApiUrl' => 'hsm_apiurl',
            'inputHsmLogin' => 'hsm_login',
            'inputHsmPassword' => 'hsm_password',
            'inputHsmPerPage' => 'hsm_perpage',
            'inputSheduleImapDailyTime' => 'shedule_ImapDailyTime',
            'inputShedulePersonsDailyTime' => 'shedule_PersonsDailyTime',
            'inputSheduleMovementsDailyTime' => 'shedule_MovementsDailyTime',
            'inputSheduleDepartmentsDailyTime' => 'shedule_DepartmentsDailyTime',
            'inputSheduleVacationDailyTime' => 'shedule_VacationDailyTime',
            'inputSheduleFreeDailyTime' => 'shedule_FreeDailyTime',
            'inputSheduleDekretDailyTime' => 'shedule_DekretDailyTime',
            'inputSheduleHSMDailyTime' => 'shedule_HSMDailyTime',
            'inputSheduleUKEPDailyTime' => 'shedule_UKEPDailyTime',
            'inputSheduleSKUDDailyTime' => 'shedule_SKUDDailyTime',
            'inputOrionSoapUrl' => 'orion_soap_url',
            'inputFTPenable' => 'ftp1c_enable',
            'inputFTPputfromimap' => 'ftp1c_putfromimap',
            'inputFTPhost' => 'ftp1c_host',
            'inputFTPuser' => 'ftp1c_user',
            'inputFTPpassword' => 'ftp1c_password',
            'inputFTPssl' => 'ftp1c_ssl',
            'inputFTPpassive' => 'ftp1c_passive',
            'inputLDAPhost' => 'ldap_host',
            'inputLDAPport' => 'ldap_port',
            'inputLDAPtimeout' => 'ldap_timeout',
            'inputLDAPbasedn' => 'ldap_basedn',
            'inputLDAPusername' => 'ldap_username',
            'inputLDAPpassword' => 'ldap_password',
            'inputLDAPtls' => 'ldap_tls',
            'inputSMTPhost' => 'smtp_host',
            'inputSMTPport' => 'smtp_port',
            'inputSMTPencryption' => 'smtp_encryption',
            'inputSMTPfrom' => 'smtp_from',
            'inputSMTPusername' => 'smtp_username',
            'inputSMTPpassword' => 'smtp_password',
            'inputIMAPhost' => 'imap_host',
            'inputIMAPport' => 'imap_port',
            'inputIMAPencryption' => 'imap_encryption',
            'inputIMAPusername' => 'imap_username',
            'inputIMAPpassword' => 'imap_password',
            'inputIMAPprotocol' => 'imap_protocol',
            'inputIMAPvalidatecert' => 'imap_validatecert',
        ];
        $validation_rules = [
            'inputPortalName' => 'required',
            'inputHsmApiUrl' => 'required|url',
            'inputHsmLogin' => 'required',
            'inputHsmPassword' => 'required',
            'inputHsmPerPage' => 'required|integer|min:100|max:300',
            'inputSheduleImapDailyTime' => 'required|date_format:H:i',
            'inputShedulePersonsDailyTime' => 'required|date_format:H:i',
            'inputSheduleMovementsDailyTime' => 'required|date_format:H:i',
            'inputSheduleDepartmentsDailyTime' => 'required|date_format:H:i',
            'inputSheduleVacationDailyTime' => 'required|date_format:H:i',
            'inputSheduleFreeDailyTime' => 'required|date_format:H:i',
            'inputSheduleDekretDailyTime' => 'required|date_format:H:i',
            'inputSheduleHSMDailyTime' => 'required|date_format:H:i',
            'inputSheduleUKEPDailyTime' => 'required|date_format:H:i',
            'inputSheduleSKUDDailyTime' => 'required|date_format:H:i',
            'inputOrionSoapUrl' => 'nullable',
            'inputFTPenable' => 'required|boolean',
            'inputFTPputfromimap' => 'required|boolean',
            'inputFTPhost' => 'required',
            'inputFTPuser' => 'required',
            'inputFTPpassword' => 'required',
            'inputFTPssl' => 'required|boolean',
            'inputFTPpassive' => 'required|boolean',
            'inputLDAPhost' => 'required',
            'inputLDAPport' => 'required|integer',
            'inputLDAPtimeout' => 'required|integer|max:90',
            'inputLDAPbasedn' => 'required',
            'inputLDAPusername' => 'required',
            'inputLDAPpassword' => 'required',
            'inputLDAPtls' => 'required|boolean',
            'inputSMTPhost' => 'required',
            'inputSMTPport' => 'required|integer',
            'inputSMTPencryption' => 'required',
            'inputSMTPfrom' => 'required|email:rfc',
            'inputSMTPusername' => 'required',
            'inputSMTPpassword' => 'required',
            'inputIMAPhost' => 'required',
            'inputIMAPport' => 'required|integer',
            'inputIMAPencryption' => 'required',
            'inputIMAPusername' => 'required',
            'inputIMAPpassword' => 'required',
            'inputIMAPprotocol' => 'required',
            'inputIMAPvalidatecert' => 'required|boolean',
        ];
        $validation_messages = [
            'inputRoom.required' => 'Не указано помещение',
            'inputPhoneMobile.digits' => 'Номер мобильного телефона должен содержать 10 цифр',
            'inputEmailAddress' => 'Не указан корректный адрес электронной почты. Адрес электронной почты должен заканчиваться на следующие значения: @48.sfr.gov.ru, @058.pfr.gov.ru, @ro48.fss.ru',
        ];
        $validator = Validator::make($request->all(), $validation_rules, $validation_messages);

        if ($validator->fails()) {
            $this->flasher_interface->addError('Проверьте заполненные данные и повторите сохранение.');
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $validatedInput = $validator->validated();
        foreach ($validatedInput as $itemKey => $itemValue) {
            $configKeyToUpdate = Arr::get($inputToConfig, $itemKey);
            if (!is_null($configKeyToUpdate)) {
                $configRow = SfrConfig::where('key', $configKeyToUpdate)->first();
                if (!is_null($configRow)) {
                    $configRow->value = $itemValue;
                    $configRow->save();
                }
            }
        }
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        $this->flasher_interface->addSuccess('Данные успешно обновлены');
        return back();
    }


    public function showConfigList()
    {
        return view('osfrportal::admin.sysconfig.configlist');
    }
}
