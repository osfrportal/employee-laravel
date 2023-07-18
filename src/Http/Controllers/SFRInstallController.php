<?php

namespace Osfrportal\OsfrportalLaravel\Http\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

use Osfrportal\OsfrportalLaravel\Models\SfrConfig;


class SFRInstallController extends Controller
{
    public function install()
    {
        $this->configInsertDefValues();
        $this->rolesInsertDefValues();
        $this->foldersCreate();
    }

    private function foldersCreate() {
        $storageDocsConfig = Storage::disk('docsfiles')->getConfig();
        $pathDocs = Arr::get($storageDocsConfig, 'root');
        if (!is_null($pathDocs)&&(!file_exists($pathDocs) || !is_dir($pathDocs))) {
            mkdir(directory: $pathDocs, permissions: 0777, recursive: true);
        }

        $storageImportsConfig = Storage::disk('imports')->getConfig();
        $pathImports = Arr::get($storageImportsConfig, 'root');
        if (!is_null($pathImports)&&(!file_exists($pathImports) || !is_dir($pathImports))) {
            mkdir(directory: $pathImports, permissions: 0777, recursive: true);
        }

        Artisan::call("storage:link");


    }
    /**
     * Summary of rolesInsertDefValues
     * @return void
     */
    private function rolesInsertDefValues()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role_oziAdmin = Role::firstOrCreate(['name' => 'ozi-admin']);

        $permissionsArray = [
            ['name' => 'permissions-manage'],
            ['name' => 'personmovements-view'],
            ['name' => 'person-view'],
            ['name' => 'person-manage'],
            ['name' => 'infosystem-view'],
            ['name' => 'infosystem-manage'],
            ['name' => 'links-manage'],
            ['name' => 'users-view'],
            ['name' => 'users-manage'],
            ['name' => 'decree-manage'],
            ['name' => 'decree-view'],
            ['name' => 'decree-sign'],
        ];
        foreach ($permissionsArray as $permissionToCreate) {
            Permission::firstOrCreate($permissionToCreate);
        }

        $rolesArray = [
            ['name' => 'ozi-admin', 'permissions' => ['decree-sign', 'decree-manage', 'users-manage', 'users-view', 'links-manage', 'infosystem-manage', 'infosystem-view', 'person-manage', 'person-view', 'personmovements-view', 'permissions-manage']],
            ['name' => 'ozi-staff', 'permissions' => ['decree-sign', 'decree-manage', 'users-view', 'links-manage', 'infosystem-manage', 'infosystem-view', 'person-view', 'personmovements-view']],
            ['name' => 'it-staff', 'permissions' => ['decree-sign', 'decree-view', 'links-manage',]],
            ['name' => 'sfr-employee', 'permissions' => ['decree-sign', 'decree-view',]],
        ];

        foreach ($rolesArray as $roleToCreate) {
            $createdRole = Role::firstOrCreate(['name' => $roleToCreate['name']]);
            $createdRole->syncPermissions($roleToCreate['permissions']);
        }
        return;
    }
    /**
     * Summary of adminSuperCreate
     * @return void
     */
    private function adminSuperCreate()
    {
        return;
    }
    /**
     * Summary of configInsertDefValues
     * @return void
     */
    private function configInsertDefValues()
    {
        SfrConfig::upsert(
            [
                ['configid' => Str::uuid(), 'key' => 'hsm_login', 'value' => 'unep_058', 'description' => '', 'crypted' => false, 'groupname' => 'hsm'],
                ['configid' => Str::uuid(), 'key' => 'hsm_password', 'value' => 'eyJpdiI6ImZhWGJOTWp6TWFrT09JK0lkajJWdWc9PSIsInZhbHVlIjoiQnZMNEo1L1RrMmlMNjJEVThwRDdJUT09IiwibWFjIjoiMDA0NmJmZmRiNTVmZDI5NDZkZTQ1YmIxMmFhYzNiYTgzZmM5ZjBlNTc1N2JhOWNhMzE2NDFmYzQ3MDI0ZjQzMCIsInRhZyI6IiJ9', 'description' => '', 'crypted' => true, 'groupname' => 'hsm'],
                ['configid' => Str::uuid(), 'key' => 'hsm_apiurl', 'value' => 'http://10.128.185.33:9000/api/', 'description' => '', 'crypted' => false, 'groupname' => 'hsm'],
                ['configid' => Str::uuid(), 'key' => 'hsm_perpage', 'value' => 100, 'description' => 'Количество строк за один запрос. Необходимо для уменьшения нагрузки на сервер', 'crypted' => false, 'groupname' => 'hsm'],
                ['configid' => Str::uuid(), 'key' => 'portal_name', 'value' => 'ОСФР по !......!', 'description' => '', 'crypted' => false, 'groupname' => 'main'],
                ['configid' => Str::uuid(), 'key' => 'shedule_ImapDailyTime', 'value' => '07:39', 'description' => 'Получение выгрузок направленных из 1С на почтовый ящик', 'crypted' => false, 'groupname' => 'shedule'],
                ['configid' => Str::uuid(), 'key' => 'shedule_PersonsDailyTime', 'value' => '07:43', 'description' => 'Загрузка информации о физических лицах', 'crypted' => false, 'groupname' => 'shedule'],
                ['configid' => Str::uuid(), 'key' => 'shedule_MovementsDailyTime', 'value' => '07:45', 'description' => 'Кадровые перемещения', 'crypted' => false, 'groupname' => 'shedule'],
                ['configid' => Str::uuid(), 'key' => 'shedule_DepartmentsDailyTime', 'value' => '07:48', 'description' => 'Загрузка кадровой информации по работникам', 'crypted' => false, 'groupname' => 'shedule'],
                ['configid' => Str::uuid(), 'key' => 'shedule_VacationDailyTime', 'value' => '07:50', 'description' => 'Загрузка отпусков', 'crypted' => false, 'groupname' => 'shedule'],
                ['configid' => Str::uuid(), 'key' => 'shedule_FreeDailyTime', 'value' => '07:50', 'description' => 'Загрузка отсутствий (командировки, отгула)', 'crypted' => false, 'groupname' => 'shedule'],
                ['configid' => Str::uuid(), 'key' => 'shedule_DekretDailyTime', 'value' => '07:52', 'description' => 'Загрузка декретов', 'crypted' => false, 'groupname' => 'shedule'],
                ['configid' => Str::uuid(), 'key' => 'shedule_HSMDailyTime', 'value' => '07:58', 'description' => 'Синхронизация сертификатов УНЭП с HSM', 'crypted' => false, 'groupname' => 'shedule'],
                ['configid' => Str::uuid(), 'key' => 'shedule_UKEPDailyTime', 'value' => '07:58', 'description' => 'Синхронизация сертификатов УКЭП из папки', 'crypted' => false, 'groupname' => 'shedule'],
                ['configid' => Str::uuid(), 'key' => 'shedule_SKUDDailyTime', 'value' => '08:00', 'description' => 'Синхронизация информации о работниках и картах доступа, блокировка карт уволенных', 'crypted' => false, 'groupname' => 'shedule'],
                ['configid' => Str::uuid(), 'key' => 'orion_soap_url', 'value' => null, 'description' => '', 'crypted' => false, 'groupname' => 'main'],
                ['configid' => Str::uuid(), 'key' => 'ftp1c_enable', 'value' => false, 'description' => 'Включить обработку файлов выгрузок 1С с FTP сервера', 'crypted' => false, 'groupname' => 'ftp1c'],
                ['configid' => Str::uuid(), 'key' => 'ftp1c_putfromimap', 'value' => false, 'description' => 'Сохранять полученные на почтовый ящик файлы выгрузок на FTP сервер', 'crypted' => false, 'groupname' => 'ftp1c'],
                ['configid' => Str::uuid(), 'key' => 'ftp1c_host', 'value' => 'poib058backup.0058.pfr.ru', 'description' => 'Адрес FTP сервера', 'crypted' => false, 'groupname' => 'ftp1c'],
                ['configid' => Str::uuid(), 'key' => 'ftp1c_user', 'value' => 'server1c', 'description' => 'Логин пользователя FTP сервера', 'crypted' => false, 'groupname' => 'ftp1c'],
                ['configid' => Str::uuid(), 'key' => 'ftp1c_password', 'value' => 'eyJpdiI6IlZVVVVMMUF4c28zODNiRVFqQTI3bXc9PSIsInZhbHVlIjoiTjJjUU9YVkNNR1lqbTZJRldZaERuQT09IiwibWFjIjoiYjI4ZWYzNTlkMjRiNWMxZDY2NGY3NzJkNWMyYmJiZmRhNDM0MWI3N2ZlMjA5OTkzYmFhNWVhMTVjODM1YmViMCIsInRhZyI6IiJ9', 'description' => 'Пароль пользователя FTP сервера', 'crypted' => true, 'groupname' => 'ftp1c'],
                ['configid' => Str::uuid(), 'key' => 'ftp1c_ssl', 'value' => false, 'description' => 'Использовать SSL при подключении к FTP серверу', 'crypted' => false, 'groupname' => 'ftp1c'],
                ['configid' => Str::uuid(), 'key' => 'ftp1c_passive', 'value' => true, 'description' => 'Пассивный режим при подключении к FTP серверу', 'crypted' => false, 'groupname' => 'ftp1c'],
                ['configid' => Str::uuid(), 'key' => 'ldap_host', 'value' => '0058.pfr.ru', 'description' => '', 'crypted' => false, 'groupname' => 'main'],
                ['configid' => Str::uuid(), 'key' => 'ldap_port', 'value' => 389, 'description' => 'Порт по умолчанию: 389, TLS: 636', 'crypted' => false, 'groupname' => 'main'],
                ['configid' => Str::uuid(), 'key' => 'ldap_timeout', 'value' => 25, 'description' => 'Таймаут взаимодействия с контроллером домена', 'crypted' => false, 'groupname' => 'main'],
                ['configid' => Str::uuid(), 'key' => 'ldap_tls', 'value' => true, 'description' => 'Взаимодействие с контроллером домена по протоколу TLS. Для корректной работы добавить в /etc/ldap/ldap.conf параметр TLS_REQCERT never', 'crypted' => false, 'groupname' => 'main'],
                ['configid' => Str::uuid(), 'key' => 'ldap_basedn', 'value' => 'dc=0058.dc=pfr,dc=ru', 'description' => '', 'crypted' => false, 'groupname' => 'main'],
                ['configid' => Str::uuid(), 'key' => 'ldap_username', 'value' => 'ozi@0058.pfr.ru', 'description' => '', 'crypted' => false, 'groupname' => 'main'],
                ['configid' => Str::uuid(), 'key' => 'ldap_password', 'value' => 'eyJpdiI6InZFVFd4aSszd3Fma1o3VGVGTEpqWUE9PSIsInZhbHVlIjoiaDRjQWFsTzhQZVZ4OTcyMlRacURsdz09IiwibWFjIjoiZTExZDMxODY2MWZiMjkwNzhlNWFhYzg5NWZmMjY5MjEyM2E5Y2Q1NmMyMTczMzkyZWUxZmZlOWYzMzhmMWQyZiIsInRhZyI6IiJ9', 'description' => '', 'crypted' => true, 'groupname' => 'main'],
                ['configid' => Str::uuid(), 'key' => 'imap_host', 'value' => 'imap.armgs.team', 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'imap_port', 'value' => 993, 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'imap_encryption', 'value' => 'ssl', 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'imap_validatecert', 'value' => false, 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'imap_username', 'value' => 'portalozi@48.sfr.gov.ru', 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'imap_password', 'value' => 'eyJpdiI6IldjNmgxa0pFTzA5UWdUTXJnbmpVN2c9PSIsInZhbHVlIjoiLzJpLzlEUEF2OUlPWUxPam90Y1FuQT09IiwibWFjIjoiZDE5OTUxNmE4YzQwYzFiY2E2YzYzNTk5ZWMwZGFkOTA2YTFlNmRmNGJkMjFlYTA5YThmNGE3ZGZlZmNiYTAyOCIsInRhZyI6IiJ9', 'description' => '', 'crypted' => true, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'imap_protocol', 'value' => 'imap', 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'smtp_host', 'value' => 'imap.armgs.team', 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'smtp_port', 'value' => 465, 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'smtp_encryption', 'value' => 'tls', 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'smtp_from', 'value' => 'portal@48.sfr.gov.ru', 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'smtp_username', 'value' => 'portalozi@48.sfr.gov.ru', 'description' => '', 'crypted' => false, 'groupname' => 'mail'],
                ['configid' => Str::uuid(), 'key' => 'smtp_password', 'value' => 'eyJpdiI6IldjNmgxa0pFTzA5UWdUTXJnbmpVN2c9PSIsInZhbHVlIjoiLzJpLzlEUEF2OUlPWUxPam90Y1FuQT09IiwibWFjIjoiZDE5OTUxNmE4YzQwYzFiY2E2YzYzNTk5ZWMwZGFkOTA2YTFlNmRmNGJkMjFlYTA5YThmNGE3ZGZlZmNiYTAyOCIsInRhZyI6IiJ9', 'description' => '', 'crypted' => true, 'groupname' => 'mail'],
            ],
            ['key'],
            ['configid', 'value', 'description', 'crypted', 'groupname']
        );
    }
}
