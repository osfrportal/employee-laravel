<div>
    <div wire:poll.5s>
        <div class="my-3 p-3 bg-body rounded shadow-sm" style="max-width: 12rem;">
            <div class="card-header">Активные пользователи</div>
            <div class="card-body text-primary">
                <h1 class="bi bi-people card-text"> {{ number_format($this->liveUsersCount, 0) }}</h1>
            </div>
        </div>
    </div>
</div>
