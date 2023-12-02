<div class="card bg-body rounded shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Уведомления</h3>
    </div>
    <div class="list-group list-group-flush list-group-hoverable">
        @foreach ($unreadNotifications as $notificationDetail)
            <div class="list-group-item">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="badge bg-danger"></span>
                    </div>
                    <div class="col text-truncate">
                        <a href="#" class="text-reset d-block">{{ $notificationDetail['updated_at'] }}</a>
                        <div class="d-block text-secondary text-truncate mt-n1">{{ $notificationDetail['data']['message'] ?? '' }}</div>
                    </div>
                    <div class="col-auto">
                        <a href="#"
                            class="list-group-item-actions"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>






<div class="my-3 p-3 bg-body rounded shadow-sm" id="SFRnotificationsList">
    <h6 class="border-bottom pb-2 mb-0">Уведомления</h6>

    @foreach ($unreadNotifications as $notificationDetail)
        <div class="d-flex text-muted pt-3 notifblock">
            <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff"
                    dy=".3em">32x32</text>
            </svg>

            <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">{{ $notificationDetail['data']['message'] ?? '' }}</strong>
                    <button type="button" class="btn btn-link btn-sm mark-as-read"
                        data-id="{{ $notificationDetail['id'] }}">Отметить прочитанным</button>
                </div>
                <span class="d-block small">{{ $notificationDetail['updated_at'] }}</span>
            </div>
        </div>
    @endforeach
    <small class="d-block text-start mt-3">
        <a href="#">Все уведомления</a>
    </small>
</div>
