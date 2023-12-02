<div class="card bg-body rounded" id="SFRnotificationsList">
    <div class="card-header bg-body">
        <h6 class="card-title">Уведомления</h6>
    </div>
    <div class="card-body">
        <div class="list-group list-group-flush list-group-hoverable">
            @foreach ($unreadNotifications as $notificationDetail)
                <div class="list-group-item notifblock">
                    <div class="row align-items-center">
                        <div class="col text-truncate">
                            <small class="text-muted d-block">{{ \Carbon\Carbon::parse($notificationDetail['updated_at'])->tz('Europe/Moscow')->format('d.m.Y H:i:s') }}</small>
                            <div class="d-block text-truncate">
                                {{ $notificationDetail['data']['message'] ?? '' }}</div>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-link btn-sm mark-as-read bi bi-check-lg"
                                data-id="{{ $notificationDetail['id'] }}"></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card-footer text-body-secondary">
            <a href="#">Все уведомления</a>
    </div>
</div>
