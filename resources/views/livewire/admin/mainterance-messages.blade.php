<div wire:poll.15s>
    <div class="card bg-body rounded shadow-sm text-center text-primary" style="max-width: 25rem;">
        <div class="card-header fs-4 bg-body">
            @if ($imapMessage->canRunImports)
                <i class="ti ti-file-check"></i>
            @else
                @if ($imapMessage->error)
                    <i class="ti ti-file-x"></i>
                @endif
                @if ($imapMessage->tryAgain)
                    <i class="ti ti-file-infinity"></i>
                @endif
            @endif
            Загрузка писем от 1С
        </div>
        <div class="card-body">
            <div class="card-text fs-6">
                {{ $imapMessage->message ?? '' }}
            </div>
        </div>
        <div class="card-footer text-muted bg-body">
            {{ $imapMessage->date }}
        </div>
    </div>
    <div class="card bg-body rounded shadow-sm text-center text-primary" style="max-width: 25rem;">
        <div class="card-header fs-4 bg-body">
            @if ($rcaMessage->importsStatus)
                <i class="ti ti-file-check"></i>
            @else
                @if ($rcaMessage->error)
                    <i class="ti ti-file-x"></i>
                @endif
                @if ($rcaMessage->tryAgain)
                    <i class="ti ti-file-infinity"></i>
                @endif
            @endif
            Загрузка файлов импорта RS:УД
        </div>
        <div class="card-body">
            <div class="card-text fs-6">
                {{ $rcaMessage->message ?? '' }}
            </div>
        </div>
        <div class="card-footer text-muted bg-body">
            {{ $rcaMessage->date }}
        </div>
    </div>
</div>
