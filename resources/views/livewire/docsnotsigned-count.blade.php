<div wire:poll.120s>
    @if ($docsNotSignedCount > 0)
        <a class="nav-link position-relative" href="{{ route('osfrportal.docs.index') }}" alt="Документы для ознакомления">
            <span
                class="position-absolute start-100 translate-middle badge rounded-pill bg-danger" title="Документов для ознакомления {{ $docsNotSignedCount }}">{{ $docsNotSignedCount }}</span>
            <i class="ti ti-file-certificate iconsMenu icon-tada icon-size-32" title="Документов для ознакомления {{ $docsNotSignedCount }}"></i>
        </a>
    @endif
</div>
