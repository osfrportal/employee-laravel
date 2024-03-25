@extends('osfrportal::layout')
@section('content')
    <div class="pt-0">
        <table class="table table-sm dataTable no-footer" id="table-appointments">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Должность</th>
                    <th>Код</th>
                    <th>Порядок сортировки</th>
                    <th>Кол-во работников</th>
                    <th>МОП</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#table-appointments').DataTable({
                dom: '<"top"flp<"clear">>rt<"bottom"ip<"clear">>',
                processing: true,
                serverSide: true,
                ordering: true,
                order: [
                    [3, 'asc'],
                ],
                ajax: "{{ route('osfrportal.admin.persons.appointments.all') }}",
                columns: [{
                        data: 'aid',
                        name: 'aid'
                    },
                    {
                        data: 'aname',
                        name: 'aname'
                    },
                    {
                        data: 'acode',
                        name: 'acode',
                    },
                    {
                        data: 'asortorder',
                        name: 'asortorder',
                    },
                    {
                        data: 'sfrpersons_count',
                        name: 'sfrpersons_count',
                    },
                    {
                        data: 'amop',
                        name: 'amop',
                    },
                ],
                columnDefs: [{
                        targets: 0,
                        orderable: false,
                        searchable: false,
                        className: 'dt-left',
                        render: function(data, type, full, meta) {
                            var url =
                                '{{ route('osfrportal.admin.persons.appointments.detail', ':slug') }}';
                            url = url.replace(':slug', data);

                            var linkView = "#";
                            return (
                                '<a href="' + url +
                                '"><i class="ti ti-edit"></i></a>'
                            );
                        },
                    },
                    {
                        targets: 1,
                        orderable: true,
                        searchable: true,
                        className: 'dt-body-left dt-head-center',
                    },
                    {
                        targets: 2,
                        orderable: true,
                        searchable: false,
                        className: 'dt-center',
                    },
                    {
                        targets: 3,
                        orderable: true,
                        searchable: false,
                        className: 'dt-center',
                    },
                    {
                        targets: 4,
                        orderable: true,
                        searchable: false,
                        className: 'dt-center',
                    },
                    {
                        targets: 5,
                        orderable: true,
                        searchable: false,
                        className: 'dt-center',
                        render: function(data, type, full, meta) {
                            if (Boolean(data) === true) {
                                return '<i class="ti ti-square-check"></i>';
                            }
                            return '<i class="ti ti-square"></i>';
                        },
                    },
                ],
            });
        });
    </script>
@endpush
