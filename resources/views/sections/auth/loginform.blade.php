<form method="POST" action="{{ route('osfrportal.login') }}">
    @csrf
    <div class="input-group mb-3">
        <input type="text" placeholder="Имя пользователя" id="username" class="form-control" name="username"
            value="{{ old('username') }}" required autocomplete="username">
    </div>
    <div class="form-group mb-3">
        <input type="password" placeholder="Пароль" id="password" class="form-control" name="password" required
            autocomplete="password">
    </div>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="1" id="remember" name="remember" @checked(old('remember'))> Запомнить
            меня
        </label>
    </div>
    <div class="d-grid mx-auto">
        <button type="submit" class="btn btn-primary btn-block">Войти</button>
    </div>
    <div class="d-grid mx-auto mt-3">
        <hr>
        <p>Для работы с порталом необходимо ввести логин/пароль.</p>
        <p>Если вы забыли пароль или у вас отсутствуют учетные данные - нажмите на кнопку "Выслать логин/пароль".</p>
    </div>
    <div class="d-grid mx-auto mt-3">
        <a href="{{ route('osfrportal.restorepass') }}" class="btn btn-info btn-block">Выслать логин/пароль</a>
    </div>
</form>
