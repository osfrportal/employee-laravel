    <div class="my-3 p-3 bg-body rounded shadow-sm text-center" style="max-width: 15rem;">
        <div class="card-header">Документов на ознакомление</div>
        <div class="card-body text-primary">
            <a class="text-decoration-none" href="{{ route('osfrportal.docs.index') }}"><h2 class="bi bi-file-medical card-text"> {{ $docsUnsignedCount ?? '0' }} </h2></a>
        </div>
    </div>
