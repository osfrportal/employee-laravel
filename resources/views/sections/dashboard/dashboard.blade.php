@extends('osfrportal::layout')
@section('content')
    <div class="row">
        <div class="col-sm-3">
            @include('osfrportal::sections.docs.informers.unsigned_docs')
        </div>
        <div class="col-sm-3">
            @include('osfrportal::sections.dashboard.informers.myip')
        </div>
    </div>
    @if (count($unreadNotifications) > 0)
        <div class="row">
            @include('osfrportal::sections.dashboard.notifications.notifications_unread')
        </div>
    @endif
    <div class="row">
        <div class="col">
            @include('osfrportal::sections.dashboard.birthdays')
        </div>
    </div>
@endsection
@push('footer-scripts')
    <script type="module">
        function sendMarkRequest(id = null) {
            return $.ajax("{{ route('osfrportal.markNotificationRead') }}", {
                method: 'POST',
                data: {
                    "_token": '{{ csrf_token() }}',
                    "id": id
                }
            });
        };
        if (document.getElementById('SFRnotificationsList')) {
            $('.mark-as-read').click(function() {
                let request = sendMarkRequest($(this).data('id'));
                request.done(() => {
                    $(this).parents('div.notifblock').remove();
                });
            });
            $('#mark-all').click(function() {
                let request = sendMarkRequest();
                request.done(() => {
                    $('div.notifblock').remove();
                })
            });
        };
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
@endpush
