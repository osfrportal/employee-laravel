@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Бизнес ресурсы</a></li>
                <li class="breadcrumb-item active">Металлические печати</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    @include('osfrportal::admin.stamps.stamp_modalissue')
    @include('osfrportal::admin.stamps.stamp_modalreturn')
    @include('osfrportal::admin.stamps.stamp_modaladdform')
    <a class="btn btn-primary" href="{{ route('osfrportal.admin.stamps.journal') }}" role="button">Журнал</a>
    <hr>
    <table class="table table-striped table-sm dataTable no-footer" id="table-stamps">
        <thead>
            <tr>
                <th>Действия</th>
                <th>Номер</th>
                <th>Описание</th>
                <th>Дата выдачи</th>
                <th>Работник</th>
                <th>Дата уничтожения</th>
                <th>Документ об уничтожении</th>
            </tr>
        </thead>
    </table>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-stamps').DataTable({
                ajax: '{{ route('osfrportal.admin.stamps.api.all') }}',
                processing: false,
                serverSide: false,
                ordering: true,
                columns: [{
                        data: 'stampid'
                    },
                    {
                        data: 'stampnumber'
                    },
                    {
                        data: 'stampdescription'
                    },
                    {
                        data: 'stamp_journal_issued.0.stampjissue_at'
                    },
                    {
                        data: 'stamp_journal_issued'
                    },
                    {
                        data: 'stampdestruct_at'
                    },
                    {
                        data: 'stampdestructdoc'
                    },
                ],
                columnDefs: [{
                        className: "dt-center",
                        targets: [0, 1, 2, 3, 4, 5, 6]
                    },
                    {
                        targets: 0,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            //var link_edit = '#' + '/' + data;
                            var link_edit = '';
                            var link_issue = '';
                            var issueJournalID = '';
                            if (!row['stampdestruct_at']) {
                                if (row['stamp_journal_issued'].length != 0) {
                                    issueJournalID = row['stamp_journal_issued'][0].stampjournalid;
                                    link_issue =
                                        '<button type="link" class="btn btn-link text-primary bi bi-person-down" data-bs-toggle="modal" data-bs-target="#stampReturnDialog" data-bs-return-stampid="' +
                                        data + '" data-bs-return-journalid="' + issueJournalID +
                                        '"></button>';
                                } else {
                                    if (row['stampdestructdoc'] === null) {
                                        stampdestructdoc = '';
                                    } else {
                                        stampdestructdoc = row['stampdestructdoc'];
                                    }
                                    link_issue =
                                        '<button type="link" class="btn btn-link text-primary bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-edit-stampid="' +
                                        data +
                                        '" data-bs-edit-stampnum="' + row['stampnumber'] +
                                        '" data-bs-edit-stampdescr="' + row['stampdescription'] +
                                        '" data-bs-edit-stampdestrat="' + row['stampdestruct_at'] +
                                        '" data-bs-edit-stampdestrdoc="' + stampdestructdoc +
                                        '"></button>' +
                                        '<button type="link" class="btn btn-link text-primary bi bi-person-up" data-bs-toggle="modal" data-bs-target="#stampIssueDialog" data-bs-whatever="' +
                                        data + '"></button>';
                                }
                            }
                            return link_issue;
                        }
                    },
                    {
                        targets: 1,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        targets: 2,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        targets: 3,
                        orderable: true,
                        searchable: true,
                        render: DataTable.render.date(),
                    },
                    {
                        targets: 4,
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row, meta) {
                            if (data[0] !== undefined) {
                                return data[0].person.psurname + ' ' + data[0].person.pname + ' ' +
                                    data[0].person.pmiddlename;
                            } else {
                                return '';
                            }
                        },
                    },
                    {
                        targets: 5,
                        orderable: true,
                        searchable: true,
                        render: DataTable.render.date(),
                    },
                    {
                        targets: 6,
                        orderable: true,
                        searchable: true,
                    },
                ],
            });
        });
    </script>
@endpush
