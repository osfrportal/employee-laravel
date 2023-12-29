@extends('osfrportal::layout')

@section('content')
    <table class="table table-responsive table-striped table-sm dataTable no-footer" id="table-certs">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Тип</th>
                <th>Работник</th>
                <th>Идентификатор узла<br>Имя узла<br>Имя пользователя (VipNet)
                    <hr>Номер лицензии
                </th>
                <th>Назначение</th>
                <th>Рабочая станция</th>


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
                        className: "dt-center align-middle",
                        targets: [0, 1, 2, 3, 4, 5, 6],
                    },
                    {
                        targets: 0,
                        orderable: false,
                        searchable: false,
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
                        orderable: true,
                        searchable: true,
                        data: 'cryptoType',
                        render: function(data, type, row, meta) {
                            var myArray = Object.values(data);
                            return myArray[1];
                        }
                    },
                    {
                        targets: 2,
                        orderable: true,
                        searchable: true,
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
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row, meta) {
                            return row.cryptoId + '<br>' + row.cryptoName + '<br>' + row
                                .cryptoUserName + '<hr>' + row.cryptoLicenseNumber;
                        }
                    },
                    {
                        targets: 4,
                        orderable: true,
                        searchable: true,
                        data: 'cryptoPurpose',
                    },
                    {
                        targets: 5,
                        orderable: true,
                        searchable: true,
                        data: 'wsId',
                    },
                ],
            });
        });
    </script>
@endpush
