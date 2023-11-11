<div>
    @if ($rootLinks->count() > 0)
        <div class="row">
            <div class="col">
                <div class="card w-100 mb-3">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="row row-cols-1 row-cols-md-5 g-4">
                                @each('osfrportal::layout.templates.linkCard', $rootLinks, 'link')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @each('osfrportal::layout.templates.linkGroup', $groupedLinks, 'groupLink')
</div>
