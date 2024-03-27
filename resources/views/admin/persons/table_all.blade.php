@extends('osfrportal::layout')
@section('content')
    <div class="pt-0">
        <table class="table table-striped table-sm dataTable no-footer " id="table-persons">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Таб. #</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Должность</th>
                    <th>Поразделение</th>
                    <th>Дата начала работы</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('footer-scripts')
    <?php
    $route_api_persons_all = route('osfrportal.admin.persons.show.all');
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-persons').DataTable({
                ajax: '{{ $route_api_persons_all }}',
                dom: '<"top"flp<"clear">>rt<"bottom"ip<"clear">>',
                ordering: true,
                serverSide: true,
                processing: true,
                order: [
                    [2, 'asc'],
                    [3, 'asc']
                ],
                columns: [{
                        data: 'pid',
                        orderable: false,
                        searchable: false,
                        className: 'dt-body-center',
                        render: function(data, type, full, meta) {

                            var url = '{{ route('osfrportal.admin.persons.detail', ':slug') }}';
                            url = url.replace(':slug', data);

                            var linkView = "#";
                            return (
                                '<a href="' + url +
                                '"><i class="bi bi-person-circle"></i></a>'
                            );
                        }
                    },
                    {
                        data: 'tabnumber',
                        className: 'dt-center',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'psurname',
                        orderable: true,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        data: 'pname',
                        orderable: false,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        data: 'pmiddlename',
                        orderable: false,
                        searchable: true,
                        className: 'dt-left',
                    },
                    {
                        data: 'appointment_name',
                        orderable: false,
                        searchable: false,
                        className: 'dt-left',
                    },
                    {
                        data: 'unit_name',
                        orderable: false,
                        searchable: false,
                        className: 'dt-left',
                    },
                    {
                        data: 'pworkstart',
                        orderable: false,
                        searchable: false,
                        className: 'dt-left',
                    },
                ],
            });
        });
    </script>
@endpush
