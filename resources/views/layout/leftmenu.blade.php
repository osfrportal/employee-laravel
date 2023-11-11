<nav id="sidebarMenu" class="col-md-3 col-lg-2  d-md-block  bg-light sidebar collapse">
    {{-- <nav id="sidebarMenu" class="col-md-3 col-lg-3  d-md-block  bg-light sidebar collapse"> --}}
    <div class="position-sticky pt-4">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ active_link('osfrportal.mainpage') }}" href="{{ route('osfrportal.mainpage') }}">
                    <span class="bi bi-house"> Главная страница</span>
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ active_link('osfrportal.phone.index') }}"
                    href="{{ route('osfrportal.phone.index') }}">
                    <span class="bi bi-telephone"> Телефонный справочник</span>
                </a>
            </li>
        </ul>
        @can('export-phones-pd')
            <ul class="nav flex-column px-3">
                <li class="nav-item">
                    <a class="nav-link {{ active_link('osfrportal.phone.export.xlsx') }}"
                        href="{{ route('osfrportal.phone.export.xlsx') }}">
                        <span class="bi bi-filetype-xlsx"> Экспорт в XLSX (Д.Р + СНИЛС)</span>
                    </a>
                </li>
            </ul>
        @endcan
        @auth
            <hr />
            @include('osfrportal::layout.leftmenu_auth')
            <hr />
        @endauth

        @livewire('osfrportal::leftmenuLinks')

        @include('osfrportal::admin.layout.leftmenu')
    </div>
</nav>
