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
            'inputUkepFolder' => 'ukep_folder',
            'inputHsmApiUrl' => 'hsm_apiurl',
            'inputHsmLogin' => 'hsm_login',
            'inputHsmPassword' => 'hsm_password',
            'inputHsmPerPage' => 'hsm_perpage',
            'inputSheduleImapDailyTime' => 'shedule_ImapDailyTime',
            'inputSheduleSync1CDailyTime' => 'shedule_Sync1CDailyTime',
            'inputSheduleHSMDailyTime' => 'shedule_HSMDailyTime',
            'inputSheduleUKEPDailyTime' => 'shedule_UKEPDailyTime',
            'inputSheduleSKUDDailyTime' => 'shedule_SKUDDailyTime',
            'inputSheduleCRLWeeklyTime' => 'shedule_CRLWeeklyTime',
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
            'inputUkepFolder' => 'required',
            'inputHsmApiUrl' => 'required|url',
            'inputHsmLogin' => 'required',
            'inputHsmPassword' => 'required',
            'inputHsmPerPage' => 'required|integer|min:100|max:300',
            'inputSheduleImapDailyTime' => 'required|date_format:H:i',
            'inputSheduleSync1CDailyTime' => 'required|date_format:H:i',
            'inputSheduleHSMDailyTime' => 'required|date_format:H:i',
            'inputSheduleUKEPDailyTime' => 'required|date_format:H:i',
            'inputSheduleSKUDDailyTime' => 'required|date_format:H:i',
            'inputSheduleCRLWeeklyTime' => 'required|date_format:H:i',
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
            '*.required' => 'Поле обязательно для заполнения',
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
