<div>
    <div class="my-3 p-3 bg-body rounded shadow-sm text-center" style="max-width: 12rem;" wire:poll.5s>
        <div class="card-header">Активные пользователи</div>
        <div class="card-body text-primary">
            <h2 class="bi bi-people card-text"> {{ number_format($this->liveUsersCount, 0) }}</h2>
        </div>
    </div>
</div>
