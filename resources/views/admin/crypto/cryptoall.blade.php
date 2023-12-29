@extends('osfrportal::layout')

@section('content')
    <table class="table table-responsive table-striped table-sm dataTable no-footer" id="table-certs">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>cryptoType</th>
                <th>cryptoId</th>
                <th>cryptoName</th>
                <th>cryptoUserName</th>
                <th>cryptoPurpose</th>
                <th>wsId</th>
                <th>cryptoLicenseNumber</th>
                <th>Работник</th>
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
                columns: [{
                        data: 'cryptouuid'
                    },
                    {
                        data: 'cryptoType'
                    },
                    {
                        data: 'cryptoId'
                    },
                    {
                        data: 'cryptoName'
                    },
                    {
                        data: 'cryptoUserName'
                    },
                    {
                        data: 'cryptoPurpose'
                    },
                    {
                        data: 'wsId'
                    },
                    {
                        data: 'cryptoLicenseNumber'
                    },
                    {
                        data: 'personContactData'
                    },
                ],
                columnDefs: [{
                        className: "dt-center",
                        targets: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                        orderable: true,
                        searchable: true,
                    },
                    {
                        targets: 0,
                        render: function(data, type, full, meta) {
                            console.log(data);
                        }
                    },
                    {
                        targets: 1,
                        render: function(data, type, full, meta) {
                            var myArray = Object.values(data);
                            return myArray[1];
                        }
                    },
                    {
                        targets: 8,
                        render: function(data, type, full, meta) {
                            if (data !== null) {
                                var personProfileUrl =
                                    '{{ route('osfrportal.admin.persons.detail', ':slug') }}';
                                personProfileUrl = personProfileUrl.replace(':slug', 'pid');
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
                ],
            });
        });
    </script>
@endpush
