@unless ($breadcrumbs->isEmpty())
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if (!$loop->last)
                        @if (!is_null($breadcrumb->url))
                            <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                        @else
                            <li class="breadcrumb-item">{{ $breadcrumb->title }}</li>
                        @endif
                    @else
                        <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
@endunless
