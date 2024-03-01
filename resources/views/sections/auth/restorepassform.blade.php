<form method="POST" action="{{ route('osfrportal.dorestorepass') }}">
    @csrf
    <div class="mb-3">
        @error('personNotFound')
            <p class="alert alert-danger"><b>ОШИБКА! <br>{{ $message }}</b></p>
        @enderror
        <p>Для получения логина и пароля введите свой ИНН</p>
        <p>Пароль будет отправлен на адрес электронной почты, указанный в телефонном справочнике.</p>
    </div>
    <div class="mb-3">
        <input type="text" placeholder="ИНН" id="inn" class="form-control @error('inn') is-invalid @enderror"
            name="inn" value="{{ old('inn') }}" required autocomplete="inn"
            data-inputmask="'mask': '999999999999'">

        @error('inn')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-grid mx-auto">
        <button type="submit" class="btn btn-primary btn-block">Выслать пароль</button>
    </div>

    <div class="mt-3 alert alert-info">
        <p>Если в телефонном справочнике не указана контактная информация - логин/пароль не может быть выслан.
            Обратитесь к руководителю подразделения для первоначального внесения данных.</p>
    </div>
</form>
