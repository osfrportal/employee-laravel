@extends('osfrportal::layout')
@section('dashboardTitle', 'Личный кабинет')
@section('content')
    @can('admin-menu-show')
    <div class="container">
        <div class="row">
          <div class="col-1">
            @livewire('osfrportal::liveusers-count')
          </div>
          <div class="col-1">
            @include('osfrportal::sections.docs.informers.unsigned_docs')
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
            @livewire('osfrportal::liveusers-count')
        </div>
        <div class="col-sm-6">
            @include('osfrportal::sections.docs.informers.unsigned_docs')
        </div>
      </div>

    @endcan

    @include('osfrportal::sections.dashboard.notifications.notifications_unread')
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
    </script>
@endpush
