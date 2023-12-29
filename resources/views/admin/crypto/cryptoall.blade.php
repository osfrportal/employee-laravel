@extends('osfrportal::layout')

@section('content')
    <table class="table table-striped table-sm dataTable no-footer" id="table-certs">
        <thead>
            <tr>
                <th>cryptoType</th>
                <th>cryptoId</th>
                <th>cryptoName</th>
                <th>cryptoUserName</th>
                <th>cryptoPurpose</th>
                <th>wsId</th>
                <th>cryptoLicenseNumber</th>
                <th>pid</th>
                <th>personContactData</th>
                <th>personContactData</th>
                <th>personContactData</th>
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
                        data: 'pid'
                    },
                    {
                        data: 'personContactData.contactUnit'
                    },
                    {
                        data: 'personContactData.contactAppointment'
                    },
                    {
                        data: 'personContactData.contactFullname'
                    },
                ],
                columnDefs: [{
                    className: "dt-center",
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    orderable: true,
                    searchable: true,
                }, ],
            });
        });
    </script>
@endpush
