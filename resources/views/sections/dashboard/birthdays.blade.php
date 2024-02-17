@if (count($personsBirthdays) > 0)
    <div class="card bg-body rounded">
        <div class="card-header">
            Дни рождения
        </div>
        <div class="card-body">
            <div class="list-group list-group-flush list-group-hoverable p-0">
                @foreach ($personsBirthdays as $personBirthday)
                    <div class="list-group-item bg-opacity-25">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                {{ $personBirthday->birthdate ?? '' }}
                            </div>
                            <div class="col">
                                <div class="ms-4">
                                    <div class="fs-6">{{ $personBirthday->fullname ?? '' }}</div>
                                    <div class="text-xs text-muted">{{ $personBirthday->appointment ?? '' }} -
                                        {{ $personBirthday->unit ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
