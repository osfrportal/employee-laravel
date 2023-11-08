<div class="card mb-4 mb-xl-0 mt-2">
    <div class="card-header">Учетные данные</div>
    <div class="card-body">
        <div class="row">
            <div class="col">Имя пользователя</div>
            <div class="col"><b>{{ $SFRUserData->username ?? '' }}</b></div>
        </div>
        <div class="row mt-2">
            <div class="col">Пароль</div>
            <div class="col">
                <form method="POST" action="{{ route('osfrportal.admin.persons.resetpassword') }}">
                    <input type="hidden" id="personid" name="personid" value="{{ $SFRPersonData->persondata_pid }}">
                    <input class="btn btn-warning btn-submit btn-sm" type="submit" id="changePassword"
                        value="Сменить пароль">
                    <p class="mt-2">При нажатии кнопки "Сменить пароль" будет
                        сгенерирован случайный пароль и направлен на адрес электронной
                        почты работника.</p>
                </form>
            </div>
        </div>
    </div>
</div>
