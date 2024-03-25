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
            var table = $('#table-movements').DataTable({
                dom: '<"top"flp<"clear">>rt<"bottom"ip<"clear">>',
                processing: true,
                serverSide: true,
                ordering: true,
                order: [
                    [0, 'desc'],
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
            });
        });
    </script>
@endpush
