<nav id="sidebarMenu" class="col-md-3 col-lg-2  d-md-block  bg-light sidebar collapse">
    {{-- <nav id="sidebarMenu" class="col-md-3 col-lg-3  d-md-block  bg-light sidebar collapse"> --}}
    <div class="position-sticky pt-4">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ active_link('osfrportal.phone.index') }}"
                    href="{{ route('osfrportal.phone.index') }}">
                    <span class="bi bi-telephone"> Телефонный справочник</span>
                </a>
            </li>
        </ul>
        @auth
            <hr />
            @include('osfrportal::layout.leftmenu_auth')
            <hr />
        @endauth
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        @include('osfrportal::admin.layout.leftmenu')
    </div>
</nav>
