<nav id="sidebarMenu" class="col-md-3 col-lg-2  d-md-block  bg-light sidebar collapse">
    {{-- <nav id="sidebarMenu" class="col-md-3 col-lg-3  d-md-block  bg-light sidebar collapse"> --}}
    <div class="position-sticky pt-4">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="https://sl05800008095.0058.pfr.ru:8445/rsiam/" target="_blank">
                    <span class="bi bi-table"> RS:Управление доступом</span>
                </a>
            </li>
        </ul>
        @can('permissions-manage')
            <hr />
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('osfrportal.admin.roles') }}">
                        <span> Управление ролями портала</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('osfrportal.admin.permissions') }}">
                        <span> Управление полномочиями портала</span>
                    </a>
                </li>
            </ul>
        @endcan
    </div>
</nav>
