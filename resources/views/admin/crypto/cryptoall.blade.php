@extends('osfrportal::layout')

@section('content')
    <table class="table table-responsive table-striped table-sm dataTable no-footer" id="table-certs">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Тип</th>
                <th>Работник</th>
                <th>Идентификатор узла<br>Имя узла<br>Имя пользователя (VipNet)</th>
                <th>Назначение</th>
                <th>Номер лицензии</th>
                <th>wsId</th>


            </tr>
        </thead>
    </table>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-certs').DataTable({
                ajax: '{{ route('osfrapi.osfrportal.admin.crypto.all') }}',
                processing: false,
                serverSide: false,
                ordering: true,
                columnDefs: [{
                        className: "dt-center",
                        targets: [0, 1, 2, 3, 4, 5, 6],
                        orderable: true,
                        searchable: true,
                    },
                    {
                        targets: 0,
                        data: 'cryptouuid',
                        render: function(data, type, row, meta) {
                            var url = '{{ route('osfrportal.admin.crypto.detail', ':slug') }}';
                            url = url.replace(':slug', data);
                            var linkView = '<a class="btn" title="Просмотр" href="' + url +
                                '"><i class="ti ti-shield icon-size-24 text-primary"></i></a>';
                            return linkView;
                        }
                    },
                    {
                        targets: 1,
                        data: 'cryptoType',
                        render: function(data, type, row, meta) {
                            var myArray = Object.values(data);
                            return myArray[1];
                        }
                    },
                    {
                        targets: 2,
                        data: 'personContactData',
                        render: function(data, type, row, meta) {
                            if (row.pid) {
                                var personProfileUrl =
                                    '{{ route('osfrportal.admin.persons.detail', ':slug') }}';
                                personProfileUrl = personProfileUrl.replace(':slug', row.pid);
                                var personOutHtml = '<a href="' + personProfileUrl +
                                    '" target="_blank" title="Просмотр профиля работника">' + data
                                    .contactFullname + '</a><br>' + data.contactAppointment +
                                    '<br>' + data.contactUnit;

                                return personOutHtml;
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        targets: 3,
                        render: function(data, type, row, meta) {
                            return row.cryptoId + '<br>' + row.cryptoName + '<br>' + row
                                .cryptoUserName;
                        }
                    },
                    {
                        targets: 4,
                        data: 'cryptoPurpose',
                    },
                    {
                        targets: 5,
                        data: 'cryptoLicenseNumber',
                    },
                    {
                        targets: 6,
                        data: 'wsId',
                    },
                ],
            });
        });
    </script>
@endpush
