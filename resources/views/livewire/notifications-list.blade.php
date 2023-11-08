<div wire:poll.5s>
    <ul class="dropdown-menu dropdown-menu-lg-end small" aria-labelledby="dropdownNotifications" style="">
        <li><a class="dropdown-item small" wire:click="goDashboard()" href="#">Все уведомления</a></li>
        <li class="dropdown-divider small"></li>
        @foreach ($unreadNotifications as $notificationDetail)
            <li class="dropdown-item notifblock small">
                <div class="pb-3 mb-0 lh-sm border-bottom w-100 dropdown-item">
                    <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark">{{ $notificationDetail['data']['message'] ?? '' }}</strong>
                        <button wire:click="markRead('{{ $notificationDetail['id'] }}')" type="button"
                            class="btn btn-link btn-sm"">Отметить
                            прочитанным</button>
                    </div>
                    <span class="d-block small">{{ $notificationDetail['updated_at'] }}</span>
                </div>
            </li>
        @endforeach
    </ul>
</div>
