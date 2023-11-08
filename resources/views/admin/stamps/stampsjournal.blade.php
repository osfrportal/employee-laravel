@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Бизнес ресурсы</a></li>
                <li class="breadcrumb-item"><a href="#">Металлические печати</a></li>
                <li class="breadcrumb-item active">Журнал</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <table class="table table-striped table-sm dataTable no-footer" id="table-stamps-journal">
        <thead>
            <tr>
                <th>№ п.п</th>
                <th>Печать</th>
                <th>Описание печати</th>
                <th>Дата выдачи</th>
                <th>Работник</th>
                <th>Дата приема</th>
            </tr>
        </thead>
    </table>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-stamps-journal').DataTable({
                ajax: '{{ route('osfrportal.admin.stamps.api.journal') }}',
                processing: false,
                serverSide: false,
                ordering: true,
                order: [
                    [0, 'asc'],
                ],
                columns: [{
                        data: 'stampjpapernumber'
                    },
                    {
                        data: 'stamp.stampnumber'
                    },
                    {
                        data: 'stamp.stampdescription'
                    },
                    {
                        data: 'stampjissue_at'
                    },
                    {
                        data: 'person'
                    },
                    {
                        data: 'stampjreturn_at'
                    },
                ],
                columnDefs: [{
                        targets: [0, 1, 2, 3, 4, 5],
                        className: "dt-center",
                        orderable: true,
                        searchable: true,
                    },
                    {
                        targets: [3, 5],
                        render: DataTable.render.date(),
                    },
                    {
                        targets: 4,
                        render: function(data, type, row, meta) {
                            if (data !== undefined) {
                                return data.psurname + ' ' + data.pname + ' ' +
                                    data.pmiddlename;
                            } else {
                                return '';
                            }
                        },
                    },
                ],
            });
        });
    </script>
@endpush
