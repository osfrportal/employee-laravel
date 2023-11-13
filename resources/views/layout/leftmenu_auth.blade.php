<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link {{ active_link('osfrportal.dashboard') }}" href="{{ route('osfrportal.dashboard') }}">
            <span class="bi bi-person-workspace"> Личный кабинет</span>
        </a>
    </li>
    <ul class="nav flex-column px-3">
        <li class="nav-item">
            <a class="nav-link {{ active_link('osfrportal.profile.index') }}"
                href="{{ route('osfrportal.profile.index') }}">
                <span class="bi bi-person-gear"> Профиль</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ active_link('osfrportal.profile.usbskdcerts') }}"
                href="{{ route('osfrportal.profile.usbskdcerts') }}">
                <span class="bi bi-passport"> Бизнес-ресурсы</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
                href="#">
                <span class="bi bi-people"> Мои заместители</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ active_link('osfrportal.docs.index') }}" href="{{ route('osfrportal.docs.index') }}">
                <span class="bi bi-archive"> Документы для ознакомления</span>
            </a>
        </li>
    </ul>
</ul>
