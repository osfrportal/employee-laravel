    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link {{ active_link('osfrportal.profile.index') }} ms-0"
            href="{{ route('osfrportal.profile.index') }}">Профиль</a>

        <!-- a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-security-page"
                                target="__blank">Безопасность</a>
                            <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"
                                target="__blank">Уведомления</a -->
        <a class="nav-link {{ active_link('osfrportal.profile.usbskdcerts') }} ms-0"
            href="{{ route('osfrportal.profile.usbskdcerts') }}">Бизнес-ресурсы</a>
    </nav>
