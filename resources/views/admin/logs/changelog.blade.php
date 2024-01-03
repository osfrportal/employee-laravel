@extends('osfrportal::layout')
@section('content')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        @foreach ($logs as $day => $detailedlogs)
            <div class="d-flex text-muted pt-3 notifblock">
                <!-- svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff"
                                    dy=".3em">32x32</text>
                            </svg -->
                <div class="pb-3 mb-0  lh-sm border-bottom w-100">
                    <span class="d-block mb-2">{{ $day }} </span>
                    <ul class="list-group list-group-flush">
                        @foreach ($detailedlogs as $detail)
                            <li class="list-group-item">
                                @switch($detail->log_type)
                                    @case(Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::ADD())
                                        <i class="ti ti-code-plus icon-size-24" title="[ADD]"></i>
                                    @break

                                    @case(Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::FIX())
                                        <i class="ti ti-code-asterix icon-size-24" title="[FIX]"></i>
                                    @break

                                    @case(Osfrportal\OsfrportalLaravel\Enums\ChangelogTypesEnum::TEST())
                                        <i class="ti ti-code-dots icon-size-24" title="[TEST]"></i>
                                    @break

                                    @default
                                        <i class="ti ti-code icon-size-24" title="[NONE]"></i>
                                @endswitch
                                {{ $detail->log_data }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
