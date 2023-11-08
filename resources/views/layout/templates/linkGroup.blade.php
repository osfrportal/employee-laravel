@if ($groupLink->children->count() > 0 || $groupLink->SfrLinks->count() > 0)
    <div class="row">
        <div class="col">
            <div class="card w-100 mb-5">
                <div class="card-body">
                    @if ($groupLink->grlcollapsed)
                        <h5 class="card-title">
                            {{ $groupLink->grlname ?? '' }}
                        </h5>
                    @else
                        <a data-bs-toggle="collapse" href="#collapse{{ $groupLink->grlid ?? '' }}" role="button"
                            aria-expanded="false" aria-controls="collapse{{ $groupLink->grlid ?? '' }}">
                            <h5 class="card-title">
                                {{ $groupLink->grlname ?? '' }}
                            </h5>
                        </a>
                    @endif
                    <div class="card-text @if (!$groupLink->grlcollapsed) collapse @endif"
                        id="collapse{{ $groupLink->grlid ?? '' }}">
                        @if ($groupLink->children->count() > 0)
                            @each('osfrportal::layout.templates.linkGroup', $groupLink->children, 'groupLink')
                        @endif
                        <div class="row row-cols-1 row-cols-md-5 g-4">
                            @each('osfrportal::layout.templates.linkCard', $groupLink->SfrLinks, 'link')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
