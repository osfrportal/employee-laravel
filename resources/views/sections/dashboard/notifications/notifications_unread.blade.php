<div class="card bg-body rounded w-50" id="SFRnotificationsList">
    <div class="card-header bg-body">
        <h6 class="card-title">Уведомления</h6>
    </div>
    <div class="card-body">
        <div class="list-group list-group-flush list-group-hoverable">
            @foreach ($unreadNotifications as $notificationDetail)
                <div class="list-group-item notifblock">
                    <div class="row align-items-center">
                        <div class="col text-truncate">
                            <small class="text-muted d-block">{{ $notificationDetail['updated_at'] }}</small>
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
