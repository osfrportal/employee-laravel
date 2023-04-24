Основной модуль портала ОСФР

Системные требования - 
* Laravel 10
* php >= 8.1

После установки пакета необходимо опубликовать настройки и миграции
php artisan vendor:publish --provider="Osfrportal\OsfrportalLaravel\Providers\OsfrportalServiceProvider\"

Интерфейс API для работы с данными
/api/osfr/v1/osfrportal/*
