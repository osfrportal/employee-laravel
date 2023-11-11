<div>
    Здравствуйте, {{ $fullname }}.<br>
    Для доступа на <a href="{{ config('app.url') }}">портал {{ config('osfrportal.portal_name') }}</a> используйте
    следующие учетные данные:<br />
    Имя пользователя: {{ $userlogin }} <br />
    Пароль: {{ $newPassword }}
    <br /><br />
    Вы можете изменить данный пароль после входа на <a href="{{ config('app.url') }}">портал
        {{ config('osfrportal.portal_name') }}</a> в разделе "Профиль"
</div>
