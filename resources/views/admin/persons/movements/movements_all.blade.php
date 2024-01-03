@extends('osfrportal::layout')
@section('content')
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Дата события</th>
                <th>Событие</th>
                <th>Работник</th>
                <th>Должность</th>
                <th>Подразделение</th>
            </tr>
        </thead>
    </table>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('osfrportal.admin.persons.movements.all') }}",
                columns: [{
                        data: 'movementeventdate',
                        name: 'movementeventdate'
                    },
                    {
                        data: 'movementtype',
                        name: 'movementtype',
                    },
                    {
                        data: 'pid',
                        name: 'pid'
                    },
                ],
                columnDefs: [{
                    targets: 1,
                    orderable: true,
                    searchable: true,
                    className: 'dt-body-center',
                    render: function(data, type, full, meta) {
                        var jsondata = JSON.stringify(data);
                        console.log(jsondata['label']);
                        return jsondata;
                    }
                }, ],
            });
        });
    </script>
@endpush
