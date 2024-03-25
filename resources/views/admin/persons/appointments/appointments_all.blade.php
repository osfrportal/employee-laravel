@extends('osfrportal::layout')
@section('content')
    <div class="pt-0">
        <table class="table table-sm dataTable no-footer" id="table-appointments">
            <thead>
                <tr>
                    <th>Должность</th>
                    <th>Код</th>
                    <th>Порядок сортировки</th>
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
                    [2, 'desc'],
                ],
                ajax: "{{ route('osfrportal.admin.persons.appointments.all') }}",
                columns: [{
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
                        data: 'amop',
                        name: 'amop',
                    },
                ],
                columnDefs: [{
                        targets: 0,
                        orderable: true,
                        searchable: true,
                        className: 'dt-body-center dt-head-center',
                    },
                    {
                        targets: 1,
                        orderable: true,
                        searchable: false,
                        className: 'dt-body-center dt-head-center',
                    },
                    {
                        targets: 2,
                        orderable: true,
                        searchable: false,
                        className: 'dt-body-center dt-head-center',
                    },
                    {
                        targets: 3,
                        orderable: true,
                        searchable: false,
                        className: 'dt-body-center dt-head-center',
                        render: function(data, type, full, meta) {
                            console.log(data);
                            if (Boolean(data) == true) {
                                return 'МОП';
                            }
                            return '---';
                        },
                    },
                ],
            });
        });
    </script>
@endpush
