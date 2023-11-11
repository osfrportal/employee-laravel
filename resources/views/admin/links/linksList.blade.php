@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item active">Ссылки</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <a class="btn btn-primary" href="{{ route('osfrportal.admin.links.add') }}" role="button">Добавить</a>
    <hr>
    <table class="table table-striped table-hover">
        <thead class="align-middle text-center">
            <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col">Название</th>
                <th scope="col">Url</th>
                <th scope="col">Группы</th>
            </tr>
        </thead>
        <tbody class="align-middle text-center">
            @foreach ($allLinks as $link)
                <tr>
                    <td>
                        <a class="bi bi-pencil-square" href="{{ route('osfrportal.admin.links.edit', $link->linkid) }}"></a>
                        &nbsp;&nbsp;
                        <a class="bi bi-trash3" href="javascript:void(0)"
                            onclick="javascript:confirmDelete('{{ route('osfrportal.admin.links.delete', $link->linkid) }}')"></a>
                    </td>
                    <td>{{ $link->linkname }}</td>
                    <td>{{ $link->linkurl }}</td>
                    <td>
                        {{ $link->LinkGroup->implode('grlname', ', ') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        function confirmDelete(url) {
            swal({
                    title: "Вы уверены?",
                    text: "Ссылка будет удалена!",
                    icon: "warning",
                    buttons: ["Отмена", "УДАЛИТЬ"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $(location).attr('href', url);
                    }
                });

        }
    </script>
@endpush
