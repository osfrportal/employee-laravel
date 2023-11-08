# Основной модуль портала ОСФР
## Системные требования

* Laravel 10
* php >= 8.1
* postgreSQL >= 15
* redis
* supervisord

## Установка:
* Создание базы данных для портала в postgresql
    ```postgresql
    =# CREATE DATABASE osfrportalprod;
    =# CREATE USER osfrportaluser WITH PASSWORD 'myPassword';
    =# GRANT ALL PRIVILEGES ON DATABASE "osfrportalprod" to osfrportaluser;
    =# \c osfrportalprod
    osfrportalprod=# GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO osfrportaluser;
    osfrportalprod=# GRANT ALL ON SCHEMA public TO osfrportaluser;
    osfrportalprod=# \q
    ```
* ``` composer create-project laravel/laravel . ```
* ``` composer require livewire/livewire "^3.0" ```
* ``` composer require osfrportal/osfrportal-laravel:dev-main ```
* В файле ``` .env ``` 
  * настроить подключение к БД:
    ```
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=osfrportalprod
    DB_USERNAME=osfrportaluser
    DB_PASSWORD=myPassword
    ```
  * установить значение переменных ```APP_DEBUG``` и ```APP_URL```:
    ```
    APP_DEBUG=false
    APP_URL=http://ваш_адрес
    ```
* ``` php artisan vendor:publish --tag permission-config ```
* ``` php artisan session:table ```
* ``` php artisan notifications:table ```
* ``` php artisan migrate ```
* ``` php artisan sfr:install ``` (будет создан администратор со случайным паролем)
* Файл ``` routes/web.php ``` необходимо привести к следующему виду:
```php
<?php

use Illuminate\Support\Facades\Route;
```
* В файл ``` .env ``` добавить:
```
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_CLIENT=predis

```


### Учетные данные для входа администратора:
    Имя пользователя: Admin
    Пароль: генерируется и показывается при установке


#### Внимание!
    Не удаляйте созданную роль SuperAdmin
