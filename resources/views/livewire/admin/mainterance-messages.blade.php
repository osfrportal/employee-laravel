<div wire:poll.15s>
    <div class="my-3 p-3 bg-body rounded shadow-sm text-center text-primary" style="max-width: 25rem;">
        <div class="card-header fs-4">
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
        <div class="card-footer text-muted">
            {{ $imapMessage->date }}
        </div>
    </div>
</div>
