@extends('osfrportal::layout')

@section('content')
    <table class="table table-responsive table-striped table-sm dataTable no-footer" id="table-certs">
        <thead>
            <tr>
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
                        targets: [0, 1, 2, 3, 4, 5, 6, 7],
                        orderable: true,
                        searchable: true,
                    },
                    {
                        targets: 7,
                        orderable: true,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            if (data !== null) {
                                return data.contactFullname + '<br>' + data.contactAppointment +
                                    '<br>' + data.contactUnit;
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
