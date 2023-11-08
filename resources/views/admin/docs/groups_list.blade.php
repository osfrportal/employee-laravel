@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item active">Разделы документов</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <a class="btn btn-primary" href="{{ route('osfrportal.admin.docs.groups.add') }}" role="button">Добавить</a>
    <hr>
    <table class="table border-top table-responsive" id="table-groups">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Раздел</th>
            </tr>
        </thead>
    </table>
@endsection
@push('footer-scripts')
    <?php
    $route_api_groups_all = route('osfrapi.osfrportal.admin.docs.groups.all');
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-groups').DataTable({
                ajax: '{{ route('osfrapi.osfrportal.admin.docs.groups.all') }}',

                columns: [{
                        data: 'groupid'
                    },
                    {
                        data: 'group_name'
                    },
                ],
                columnDefs: [{
                    // Actions
                    targets: 0,
                    title: 'Действия',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {

                        var url = '{{ route('osfrportal.admin.docs.groups.detail', ':slug') }}';
                        url = url.replace(':slug', data);

                        var link_edit = "#";
                        return (
                            '<a href="' + link_edit +
                            '" class="btn btn-sm text-primary btn-icon item-edit"><i class="bi bi-pencil-square"></i></a>'
                        );
                    }
                }],
            });
        });
    </script>
@endpush
