    @if ($docsUnsignedCount > 0)
        <div class="my-3 p-3 bg-body rounded shadow-sm text-center" style="max-width: 15rem;">
            <div class="card-header">Документов на ознакомление</div>
            <div class="card-body text-primary">
                <div class="card-text fs-4"><a class="text-decoration-none" href="{{ route('osfrportal.docs.index') }}"><i
                            class="bi bi-file-medical"></i> {{ $docsUnsignedCount ?? '0' }} </a></div>
            </div>
        </div>
    @endif
