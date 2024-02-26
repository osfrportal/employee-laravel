<div wire:poll.5s>
    <div class="my-3 p-3 bg-body rounded shadow-sm text-center" style="max-width: 15rem;">
        <div class="card-header">IMAP загрузка писем от 1С</div>
        <div class="card-body text-primary">
            <div class="card-text fs-4">
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
                {{ $imapMessage->message ?? '' }}
            </div>
        </div>
        <div class="card-footer text-muted">
            {{ $imapMessage->date }}
        </div>
    </div>
</div>
