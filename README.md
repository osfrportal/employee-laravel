Основной модуль портала ОСФР

Системные требования -

* Laravel 10
* php >= 8.1

После установки пакета необходимо опубликовать настройки и миграции
php artisan vendor:publish --provider="Osfrportal\OsfrportalLaravel\Providers\OsfrportalServiceProvider\"

Интерфейс API для работы с данными
/api/osfr/v1/osfrportal/*

настроить spatie/laravel-permission
<https://spatie.be/docs/laravel-permission/v5/installation-laravel>
<https://spatie.be/docs/laravel-permission/v5/advanced-usage/uuid>

Изменить настройки аутентификации в файле config/auth.php на:
в раздел
'providers' => [
добавить
'sfrusers' => [
            'driver' => 'eloquent',
            'model' => Osfrportal\OsfrportalLaravel\Models\SfrUser::class,
        ],
В разделе
'defaults' => [
значение 'passwords' установить на 'sfrusers'

в разделе 'guards' => [
значение 'provider' установить на 'sfrusers'

composer require yajra/laravel-datatables-oracle:"^10.0"
