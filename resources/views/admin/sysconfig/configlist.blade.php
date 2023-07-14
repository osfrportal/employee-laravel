@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Конфигурация портала</a></li>
                <li class="breadcrumb-item active">Основные настройки</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('osfrportal.admin.sysconfig.save') }}">
        <div class="card mb-4">
            <div class="card-header">Основные настройки</div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="mb-3">
                        <label class="mb-1" for="inputPortalName">Наименование портала:</label>
                        <input class="form-control form-control-sm @error('inputPortalName') is-invalid @enderror"
                            id="inputPortalName" name="inputPortalName" type="text"
                            value="{{ old('inputPortalName') ?? (config('osfrportal.portal_name') ?? '') }}">
                        @error('inputPortalName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">Настройки VipNet HSM</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="mb-1" for="inputHsmApiUrl">Адрес API:</label>
                    <input class="form-control form-control-sm @error('inputHsmApiUrl') is-invalid @enderror"
                        id="inputHsmApiUrl" name="inputHsmApiUrl" type="text"
                        value="{{ old('inputHsmApiUrl') ?? (config('osfrportal.hsm_apiurl') ?? '') }}">
                    @error('inputHsmApiUrl')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputLogin">Login:</label>
                    <input class="form-control form-control-sm @error('inputLogin') is-invalid @enderror" id="inputLogin"
                        name="inputLogin" type="text"
                        value="{{ old('inputLogin') ?? (config('osfrportal.hsm_login') ?? '') }}">
                    @error('inputLogin')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputHsmPassword">Password:</label>
                    <input class="form-control form-control-sm @error('inputHsmPassword') is-invalid @enderror"
                        id="inputHsmPassword" name="inputHsmPassword" type="text"
                        value="{{ old('inputHsmPassword') ?? (config('osfrportal.hsm_password') ?? '') }}">
                    @error('inputHsmPassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputHsmPerPage">Записей на страницу:</label>
                    <input class="form-control form-control-sm @error('inputHsmPerPage') is-invalid @enderror"
                        id="inputHsmPerPage" name="inputHsmPerPage" type="text"
                        value="{{ old('inputHsmPerPage') ?? (config('osfrportal.hsm_perpage') ?? '') }}">
                    @error('inputHsmPerPage')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">Планировщик</div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="mb-3">
                        <label class="mb-1" for="inputSheduleImapDailyTime">ImapDailyTime</label>
                        <input class="form-control form-control-sm @error('inputSheduleImapDailyTime') is-invalid @enderror"
                            id="inputSheduleImapDailyTime" name="inputSheduleImapDailyTime" type="time"
                            value="{{ old('inputShedule') ?? (config('osfrportal.shedule_ImapDailyTime') ?? '') }}"
                            width="200">
                        @error('inputSheduleImapDailyTime')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="inputShedulePersonsDailyTime">PersonsDailyTime</label>
                        <input
                            class="form-control form-control-sm @error('inputShedulePersonsDailyTime') is-invalid @enderror"
                            id="inputShedulePersonsDailyTime" name="inputShedulePersonsDailyTime" type="time"
                            value="{{ old('inputShedulePersonsDailyTime') ?? (config('osfrportal.shedule_PersonsDailyTime') ?? '') }}"
                            width="200">
                        @error('inputShedulePersonsDailyTime')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="inputSheduleMovementsDailyTime">MovementsDailyTime</label>
                        <input
                            class="form-control form-control-sm @error('inputSheduleMovementsDailyTime') is-invalid @enderror"
                            id="inputSheduleMovementsDailyTime" name="inputSheduleMovementsDailyTime" type="time"
                            value="{{ old('inputSheduleMovementsDailyTime') ?? (config('osfrportal.shedule_MovementsDailyTime') ?? '') }}"
                            width="200">
                        @error('inputSheduleMovementsDailyTime')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="inputSheduleDepartmentsDailyTime">DepartmentsDailyTime</label>
                        <input
                            class="form-control form-control-sm @error('inputSheduleDepartmentsDailyTime') is-invalid @enderror"
                            id="inputSheduleDepartmentsDailyTime" name="inputSheduleDepartmentsDailyTime" type="time"
                            value="{{ old('inputSheduleDepartmentsDailyTime') ?? (config('osfrportal.shedule_DepartmentsDailyTime') ?? '') }}"
                            width="200">
                        @error('inputSheduleDepartmentsDailyTime')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="inputSheduleVacationDailyTime">VacationDailyTime</label>
                        <input
                            class="form-control form-control-sm @error('inputSheduleVacationDailyTime') is-invalid @enderror"
                            id="inputSheduleVacationDailyTime" name="inputSheduleVacationDailyTime" type="time"
                            value="{{ old('inputSheduleVacationDailyTime') ?? (config('osfrportal.shedule_VacationDailyTime') ?? '') }}"
                            width="200">
                        @error('inputSheduleVacationDailyTime')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="inputSheduleFreeDailyTime">FreeDailyTime</label>
                        <input
                            class="form-control form-control-sm @error('inputSheduleFreeDailyTime') is-invalid @enderror"
                            id="inputSheduleFreeDailyTime" name="inputSheduleFreeDailyTime" type="time"
                            value="{{ old('inputSheduleFreeDailyTime') ?? (config('osfrportal.shedule_FreeDailyTime') ?? '') }}"
                            width="200">
                        @error('inputSheduleFreeDailyTime')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="inputSheduleDekretDailyTime">DekretDailyTime</label>
                        <input
                            class="form-control form-control-sm @error('inputSheduleDekretDailyTime') is-invalid @enderror"
                            id="inputSheduleDekretDailyTime" name="inputSheduleDekretDailyTime" type="time"
                            value="{{ old('inputSheduleDekretDailyTime') ?? (config('osfrportal.shedule_DekretDailyTime') ?? '') }}"
                            width="200">
                        @error('inputSheduleDekretDailyTime')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="inputSheduleHSMDailyTime">HSMDailyTime</label>
                        <input
                            class="form-control form-control-sm @error('inputSheduleHSMDailyTime') is-invalid @enderror"
                            id="inputSheduleHSMDailyTime" name="inputSheduleHSMDailyTime" type="time"
                            value="{{ old('inputSheduleHSMDailyTime') ?? (config('osfrportal.shedule_HSMDailyTime') ?? '') }}"
                            width="200">
                        @error('inputSheduleHSMDailyTime')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="inputSheduleUKEPDailyTime">UKEPDailyTime</label>
                        <input
                            class="form-control form-control-sm @error('inputSheduleUKEPDailyTime') is-invalid @enderror"
                            id="inputSheduleUKEPDailyTime" name="inputSheduleUKEPDailyTime" type="time"
                            value="{{ old('inputSheduleUKEPDailyTime') ?? (config('osfrportal.shedule_UKEPDailyTime') ?? '') }}"
                            width="200">
                        @error('inputSheduleUKEPDailyTime')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1" for="inputSheduleSKUDDailyTime">SKUDDailyTime</label>
                        <input
                            class="form-control form-control-sm @error('inputSheduleSKUDDailyTime') is-invalid @enderror"
                            id="inputSheduleSKUDDailyTime" name="inputSheduleSKUDDailyTime" type="time"
                            value="{{ old('inputSheduleSKUDDailyTime') ?? (config('osfrportal.shedule_SKUDDailyTime') ?? '') }}"
                            width="200">
                        @error('inputSheduleSKUDDailyTime')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">СКУД</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="mb-1" for="inputOrionSoapUrl">Адрес интерфейса ОрионПРО:</label>
                    <input class="form-control form-control-sm @error('inputOrionSoapUrl') is-invalid @enderror"
                        id="inputOrionSoapUrl" name="inputOrionSoapUrl" type="text"
                        value="{{ old('inputOrionSoapUrl') ?? (config('osfrportal.orion_soap_url') ?? '') }}">
                    @error('inputOrionSoapUrl')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">FTP</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="mb-1" for="inputFTPenable">Загрузка файлов 1C с FTP</label>
                    <select class="form-select" id="inputFTPenable" name="inputFTPenable">
                        <option>Выберите...</option>
                        <option value="0" @selected(old('inputFTPenable', config('osfrportal.ftp1c_enable')) == 0)>Выключено</option>
                        <option value="1" @selected(old('inputFTPenable', config('osfrportal.ftp1c_enable')) == 1)>Включено</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputFTPputfromimap">Сохранять выгрузки, полученные по IMAP на FTP</label>
                    <select class="form-select" id="inputFTPputfromimap" name="inputFTPputfromimap">
                        <option>Выберите...</option>
                        <option value="0" @selected(old('inputFTPputfromimap', config('osfrportal.ftp1c_putfromimap')) == 0)>Выключено</option>
                        <option value="1" @selected(old('inputFTPputfromimap', config('osfrportal.ftp1c_putfromimap')) == 1)>Включено</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputFTPhost">host</label>
                    <input class="form-control form-control-sm @error('inputFTPhost') is-invalid @enderror"
                        id="inputFTPhost" name="inputFTPhost" type="text"
                        value="{{ old('inputFTPhost') ?? (config('osfrportal.ftp1c_host') ?? '') }}">
                    @error('inputFTPhost')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputFTPuser">user</label>
                    <input class="form-control form-control-sm @error('inputFTPuser') is-invalid @enderror"
                        id="inputFTPuser" name="inputFTPuser" type="text"
                        value="{{ old('inputFTPuser') ?? (config('osfrportal.ftp1c_user') ?? '') }}">
                    @error('inputFTPuser')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputFTPpassword">password</label>
                    <input class="form-control form-control-sm @error('inputFTPpassword') is-invalid @enderror"
                        id="inputFTPpassword" name="inputFTPpassword" type="text"
                        value="{{ old('inputFTPpassword') ?? (config('osfrportal.ftp1c_password') ?? '') }}">
                    @error('inputFTPpassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputFTPssl">Тип шифрования</label>
                    <select class="form-select" id="inputFTPssl" name="inputFTPssl">
                        <option>Выберите...</option>
                        <option value="0" @selected(old('inputFTPssl', config('osfrportal.ftp1c_ssl')) == 0)>Disable encryption</option>
                        <option value="1" @selected(old('inputFTPssl', config('osfrportal.ftp1c_ssl')) == 1)>Use SSL</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputFTPpassive">Режим работы</label>
                    <select class="form-select" id="inputFTPpassive" name="inputFTPpassive">
                        <option>Выберите...</option>
                        <option value="1" @selected(old('inputFTPpassive', config('osfrportal.ftp1c_passive')) == 1)>Пассивный</option>
                        <option value="0" @selected(old('inputFTPpassive', config('osfrportal.ftp1c_passive')) == 0)>Активный</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">LDAP (взаимодействие с доменом)</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="mb-1" for="inputLDAPhost">host</label>
                    <input class="form-control form-control-sm @error('inputLDAPhost') is-invalid @enderror"
                        id="inputLDAPhost" name="inputLDAPhost" type="text"
                        value="{{ old('inputLDAPhost') ?? (config('osfrportal.ldap_host') ?? '') }}">
                    @error('inputLDAPhost')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputLDAPport">port</label>
                    <input class="form-control form-control-sm @error('inputLDAPport') is-invalid @enderror"
                        id="inputLDAPport" name="inputLDAPport" type="text"
                        value="{{ old('inputLDAPport') ?? (config('osfrportal.ldap_port') ?? '') }}">
                    @error('inputLDAPport')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputLDAPtimeout">timeout</label>
                    <input class="form-control form-control-sm @error('inputLDAPtimeout') is-invalid @enderror"
                        id="inputLDAPtimeout" name="inputLDAPtimeout" type="text"
                        value="{{ old('inputLDAPtimeout') ?? (config('osfrportal.ldap_timeout') ?? '') }}">
                    @error('inputLDAPtimeout')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputLDAPbasedn">basedn</label>
                    <input class="form-control form-control-sm @error('inputLDAPbasedn') is-invalid @enderror"
                        id="inputLDAPbasedn" name="inputLDAPbasedn" type="text"
                        value="{{ old('inputLDAPbasedn') ?? (config('osfrportal.ldap_basedn') ?? '') }}">
                    @error('inputLDAPbasedn')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputLDAPusername">username</label>
                    <input class="form-control form-control-sm @error('inputLDAPusername') is-invalid @enderror"
                        id="inputLDAPusername" name="inputLDAPusername" type="text"
                        value="{{ old('inputLDAPusername') ?? (config('osfrportal.ldap_username') ?? '') }}">
                    @error('inputLDAPusername')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputLDAPpassword">password</label>
                    <input class="form-control form-control-sm @error('inputLDAPpassword') is-invalid @enderror"
                        id="inputLDAPpassword" name="inputLDAPpassword" type="text"
                        value="{{ old('inputLDAPpassword') ?? (config('osfrportal.ldap_password') ?? '') }}">
                    @error('inputLDAPpassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputLDAPtls">Тип шифрования</label>
                    <select class="form-select" id="inputLDAPtls" name="inputLDAPtls">
                        <option>Выберите...</option>
                        <option value="0" @selected(old('inputLDAPtls', config('osfrportal.ldap_tls')) == 0)>Disable encryption</option>
                        <option value="1" @selected(old('inputLDAPtls', config('osfrportal.ldap_tls')) == 1)>Use TLS</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">Почта (IMAP/SMTP)</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="mb-1" for="inputSMTPhost">host</label>
                    <input class="form-control form-control-sm @error('inputSMTPhost') is-invalid @enderror"
                        id="inputSMTPhost" name="inputSMTPhost" type="text"
                        value="{{ old('inputSMTPhost') ?? (config('osfrportal.smtp_host') ?? '') }}">
                    @error('inputSMTPhost')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputSMTPport">port</label>
                    <input class="form-control form-control-sm @error('inputSMTPport') is-invalid @enderror"
                        id="inputSMTPport" name="inputSMTPport" type="text"
                        value="{{ old('inputSMTPport') ?? (config('osfrportal.smtp_port') ?? '') }}">
                    @error('inputSMTPport')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputSMTPencryption">Тип шифрования</label>
                    <select class="form-select" id="inputSMTPencryption" name="inputSMTPencryption">
                        <option>Выберите...</option>
                        <option value="0" @selected(old('inputSMTPencryption', config('osfrportal.smtp_encryption')) == 0)>Disable encryption</option>
                        <option value="tls" @selected(old('inputSMTPencryption', config('osfrportal.smtp_encryption')) == 'tls')>Use TLS</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputSMTPfrom">from</label>
                    <input class="form-control form-control-sm @error('inputSMTPfrom') is-invalid @enderror"
                        id="inputSMTPfrom" name="inputSMTPfrom" type="text"
                        value="{{ old('inputSMTPfrom') ?? (config('osfrportal.smtp_from') ?? '') }}">
                    @error('inputSMTPfrom')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputSMTPusername">username</label>
                    <input class="form-control form-control-sm @error('inputSMTPusername') is-invalid @enderror"
                        id="inputSMTPusername" name="inputSMTPusername" type="text"
                        value="{{ old('inputSMTPusername') ?? (config('osfrportal.smtp_username') ?? '') }}">
                    @error('inputSMTPusername')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputSMTPpassword">password</label>
                    <input class="form-control form-control-sm @error('inputSMTPpassword') is-invalid @enderror"
                        id="inputSMTPpassword" name="inputSMTPpassword" type="text"
                        value="{{ old('inputSMTPpassword') ?? (config('osfrportal.smtp_password') ?? '') }}">
                    @error('inputSMTPpassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <hr>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputIMAPhost">host</label>
                    <input class="form-control form-control-sm @error('inputIMAPhost') is-invalid @enderror"
                        id="inputIMAPhost" name="inputIMAPhost" type="text"
                        value="{{ old('inputIMAPhost') ?? (config('osfrportal.imap_host') ?? '') }}">
                    @error('inputIMAPhost')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputIMAPport">port</label>
                    <input class="form-control form-control-sm @error('inputIMAPport') is-invalid @enderror"
                        id="inputIMAPport" name="inputIMAPport" type="text"
                        value="{{ old('inputIMAPport') ?? (config('osfrportal.imap_port') ?? '') }}">
                    @error('inputIMAPport')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputIMAPencryption">Тип шифрования</label>
                    <select class="form-select" id="inputIMAPencryption" name="inputIMAPencryption">
                        <option>Выберите...</option>
                        <option value="0" @selected(old('inputIMAPencryption', config('osfrportal.imap_encryption')) == 0)>Disable encryption</option>
                        <option value="ssl" @selected(old('inputIMAPencryption', config('osfrportal.imap_encryption')) == 'ssl')>Use SSL</option>
                        <option value="tls" @selected(old('inputIMAPencryption', config('osfrportal.imap_encryption')) == 'tls')>Use TLS</option>
                        <option value="starttls" @selected(old('inputIMAPencryption', config('osfrportal.imap_encryption')) == 'starttls')>Use STARTTLS (alias TLS) (legacy only)
                        </option>
                        <option value="notls" @selected(old('inputIMAPencryption', config('osfrportal.imap_encryption')) == 'notls')>Use NoTLS (legacy only)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="mb-1" for="inputIMAPusername">username</label>
                    <input class="form-control form-control-sm @error('inputIMAPusername') is-invalid @enderror"
                        id="inputIMAPusername" name="inputIMAPusername" type="text"
                        value="{{ old('inputIMAPusername') ?? (config('osfrportal.imap_username') ?? '') }}">
                    @error('inputIMAPusername')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputIMAPpassword">password</label>
                    <input class="form-control form-control-sm @error('inputIMAPpassword') is-invalid @enderror"
                        id="inputIMAPpassword" name="inputIMAPpassword" type="text"
                        value="{{ old('inputIMAPpassword') ?? (config('osfrportal.imap_password') ?? '') }}">
                    @error('inputIMAPpassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputIMAPprotocol">Протокол подключения</label>
                    <select class="form-select" id="inputIMAPprotocol" name="inputIMAPprotocol">
                        <option>Выберите...</option>
                        <option value="imap" @selected(old('inputIMAPprotocol', config('osfrportal.imap_protocol')) == 'imap')>imap</option>
                        <option value="legacy-imap" @selected(old('inputIMAPprotocol', config('osfrportal.imap_protocol')) == 'legacy-imap')>legacy-imap</option>
                        <option value="pop3" @selected(old('inputIMAPprotocol', config('osfrportal.imap_protocol')) == 'pop3')>pop3</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="inputIMAPvalidatecert">Проверка сертификата сервера</label>
                    <select class="form-select" id="inputIMAPvalidatecert" name="inputIMAPvalidatecert">
                        <option>Выберите...</option>
                        <option value="1" @selected(old('inputIMAPvalidatecert', config('osfrportal.imap_validatecert')) == 1)>Включено</option>
                        <option value="0" @selected(old('inputIMAPvalidatecert', config('osfrportal.imap_validatecert')) == 0)>Выключено</option>
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-primary btn-submit" type="submit">Сохранить</button>
    </form>
@endsection
