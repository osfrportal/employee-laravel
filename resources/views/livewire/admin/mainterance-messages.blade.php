<div wire:poll.15s>
    <div class="my-3 p-3 bg-body rounded shadow-sm text-center text-primary" style="max-width: 25rem;">
        <div class="card-header">IMAP загрузка писем от 1С</div>
        <div class="card-body">
            <div class="card-text">
                <div class="fs-4">
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
                </div>
                <div class="fs-6">
                    {{ $imapMessage->message ?? '' }}
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            {{ $imapMessage->date }}
        </div>
    </div>
</div>
