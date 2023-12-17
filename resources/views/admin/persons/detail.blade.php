@extends('osfrportal::layout')
@push('footer-scripts')
    <script type="module">
        var triggerTabList = [].slice.call(document.querySelectorAll('#person-tab a'));
        triggerTabList.forEach(function(triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', function(event) {
                event.preventDefault()
                tabTrigger.show()
            })
        });
    </script>
@endpush
@section('breadcrumb')
    {{ Breadcrumbs::render('osfrportal.admin.persons.detail', $SFRPersonData->persondata_fullname ? $SFRPersonData->persondata_fullname : '') }}
@endsection
@section('content')
    <div class="container-fluid float-start">
        <nav>
            <div class="nav nav-tabs" id="person-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"><span
                        class="bi bi-file-earmark-person"> Основные данные</span></a>
                <a class="nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-businessresources" role="tab"><i class="ti ti-apps"></i> Бизнес-ресурсы</a>
                <a class="nav-link" id="nav-docs-tab" data-toggle="tab" href="#nav-docs" role="tab"><span
                        class="bi bi-layout-text-window"> Ознакомление</span></a>
                <a class="nav-link" id="nav-ad-tab" data-toggle="tab" href="#nav-ad" role="tab"><i class="ti ti-badge-ad"></i> ActiveDirectory</a>
                <a class="nav-link" id="nav-activity-tab" data-toggle="tab" href="#nav-activity" role="tab"><i class="ti ti-activity"></i> Активность на портале</a>

        </nav>
        <div class="tab-content" id="person-tabContent">
            <div class="tab-pane show active" id="nav-home" role="tabpanel">
                <div class="container-fluid px-4 mt-4">
                    <div class="row">
                        <div class="col">
                            @include('osfrportal::admin.persons.details.main')
                            @include('osfrportal::admin.persons.details.user')
                        </div>
                        <div class="col">
                            @include('osfrportal::admin.persons.details.contactdata')
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="nav-businessresources" role="tabpanel">
                @include('osfrportal::admin.persons.details.business_resources')
            </div>
            <div class="tab-pane" id="nav-ad" role="tabpanel">..ad.</div>
            <div class="tab-pane" id="nav-docs" role="tabpanel">
                <div class="m-2">
                    <a href="{{ route('osfrportal.admin.persons.print.docs.signlist', $SFRPersonData->persondata_pid) }}"
                        target="_blank" class="btn btn-primary" role="button">Печать</a>
                </div>
                @include('osfrportal::admin.persons.details.docssigns')
            </div>
            <div class="tab-pane" id="nav-activity" role="tabpanel">
                @include('osfrportal::admin.persons.details.activity_timeline')
            </div>

        </div>
    </div>
@endsection
