@extends('osfrportal::layout')
@section('content')
    <div class="pt-0">
        <table class="table table-striped table-sm dataTable no-footer" id="table-movements">
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
                    {
                        data: 'movementdata',
                    },
                    {
                        data: 'movementdata',
                    },
                ],
                columnDefs: [{
                        targets: 0,
                        orderable: true,
                        searchable: true,
                        className: 'dt-body-center',
                    },
                    {
                        targets: 1,
                        orderable: true,
                        searchable: true,
                        className: 'dt-body-center',
                        render: function(data, type, full, meta) {
                            let arr = Object.values(data);
                            return arr[1];
                        }
                    },
                    {
                        targets: 2,
                        orderable: true,
                        searchable: true,
                        className: 'dt-body-center',
                    },
                    {
                        targets: 3,
                        orderable: true,
                        searchable: true,
                        className: 'dt-body-center',
                        render: function(data, type, full, meta) {
                            let arr = Object.entries(data);
                            console.table(arr);
                            return data;
                        }
                    },
                    {
                        targets: 4,
                        orderable: true,
                        searchable: true,
                        className: 'dt-body-center',
                    },
                ],
            });
        });
    </script>
@endpush
