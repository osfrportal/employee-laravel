@extends('osfrportal::layout')
@section('content')
    <div class="pt-0">
        <table class="table table-striped table-sm dataTable no-footer " id="table-movements">
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
    </div>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#table-movements').DataTable({
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
                        //console.table(JSON.stringify(data));
                        console.table(data);
                        console.log(data['* value']);
                        return data;
                    }
                }, ],
            });
        });
    </script>
@endpush
