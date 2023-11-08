<div wire:poll.5s>
    <i class="bi bi-bell iconsMenu"></i>
    @if ($unreadNotificationsCount > 0)
        <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
            {{ $unreadNotificationsCount }}
        </span>
    @endif
</div>
