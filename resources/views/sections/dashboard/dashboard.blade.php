@extends('osfrportal::layout')
@section('dashboardTitle', 'Личный кабинет')
@section('content')
    @can('admin-menu-show')
        <div class="row">
            <div class="col-sm-2">
                @livewire('osfrportal::liveusers-count')
            </div>
            <div class="col-sm-2">
                <div id="liveusersChart">
                </div>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-sm-3">
            @include('osfrportal::sections.docs.informers.unsigned_docs')
        </div>
    </div>
    @include('osfrportal::sections.dashboard.notifications.notifications_unread')
@endsection
@push('footer-scripts')
    <script type="module">
        var options = {
          series: [70],
          chart: {
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
            hollow: {
              size: '70%',
            }
          },
        },
        labels: ['Активные пользователи'],
        };

        var chart = new ApexCharts(document.querySelector("#liveusersChart"), options);
        chart.render();

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
