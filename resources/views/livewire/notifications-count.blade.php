<div wire:poll.240s>
    @if ($unreadNotificationsCount > 0)
        <a class="nav-link position-relative" href="{{ route('osfrportal.dashboard') }}" alt="Уведомления"
            id="dropdownNotifications">
            <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger"
                title="{{ $unreadNotificationsCount }} непрочитанных уведомлений">{{ $unreadNotificationsCount }}</span>
            <i class="ti ti-bell iconsMenu icon-tada icon-size-32"
                title="{{ $unreadNotificationsCount }} непрочитанных уведомлений"></i>

        </a>
    @endif
</div>
