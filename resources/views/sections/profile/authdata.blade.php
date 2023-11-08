<div class="card mb-4 mb-xl-0 mt-2">
    <div class="card-header">Учетные данные</div>
    <div class="card-body">
        <div class="row">
            <div class="col">Имя пользователя</div>
            <div class="col">
                <input class="form-control form-control-sm" id="inputLogin" type="text"
                    value="{{ Auth::user()->username }}" disabled readonly>
            </div>
        </div>
        <form method="POST" action="{{ route('osfrportal.profile.passchange') }}">
            <input type="hidden" id="personid" name="personid" value="{{ $SFRPersonData->persondata_pid }}">
            <div class="row mt-2">
                <div class="col">Текущий пароль:</div>
                <div class="col"><input
                        class="form-control form-control-sm @error('inputCurrentPassword') is-invalid @enderror"
                        id="inputCurrentPassword" name="inputCurrentPassword" type="password"
                        placeholder="Введите текущий пароль">
                    @error('inputCurrentPassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">Новый пароль:</div>
                <div class="col"><input
                        class="form-control form-control-sm @error('inputNewPassword') is-invalid @enderror"
                        id="inputNewPassword" name="inputNewPassword" type="password"
                        placeholder="Введите новый пароль">
                    @error('inputNewPassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">Повторите новый пароль:</div>
                <div class="col"><input
                        class="form-control form-control-sm @error('inputNewPassword2') is-invalid @enderror"
                        id="inputNewPassword2" name="inputNewPassword2" type="password"
                        placeholder="Повторите новый пароль">
                    @error('inputNewPassword2')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mt-2">
                <div class="col"></div>
                <div class="col">
                    <input class="btn btn-warning btn-submit btn-sm" type="submit" id="changePassword"
                        value="Сменить пароль">
                </div>
            </div>
        </form>
    </div>
</div>
