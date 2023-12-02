<div class="card bg-body rounded w-50" id="SFRnotificationsList">
    <div class="card-header bg-body">
        <h6 class="card-title">Уведомления</h6>
    </div>
    <div class="card-body">
        <div class="list-group list-group-flush list-group-hoverable">
            @foreach ($unreadNotifications as $notificationDetail)
                <div class="list-group-item text-muted notifblock">
                    <div class="row align-items-center">
                        <div class="col text-truncate">
                            <span class="text-reset d-block">{{ $notificationDetail['updated_at'] }}</span>
                            <div class="d-block text-secondary text-truncate mt-n1">
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
        <small class="d-block text-start mt-3">
            <a href="#">Все уведомления</a>
        </small>
    </div>
</div>
