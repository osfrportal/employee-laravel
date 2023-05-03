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
</form>
