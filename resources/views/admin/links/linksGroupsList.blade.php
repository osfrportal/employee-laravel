@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item active">Группы ссылок</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
<a class="btn btn-primary" href="{{ route('osfrportal.admin.links.groups.add') }}" role="button">Добавить</a>
    <hr>
    <table class="table table-striped table-hover">
        <thead class="align-middle text-center">
            <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col">Группа</th>
                <th scope="col">Порядок сортировки</th>
                <th scope="col">Родительская группа</th>
                <th scope="col">Вид отображения</th>
            </tr>
        </thead>
        <tbody class="align-middle text-center">
            @foreach ($allGroups as $group)
                <tr>
                    <td>
                        <a class="bi bi-pencil-square"
                            href="{{ route('osfrportal.admin.links.groups.edit', $group->grlid) }}"></a>
                        &nbsp;&nbsp;
                        <a class="bi bi-trash3" href="javascript:void(0)"
                            onclick="javascript:confirmDelete('{{ route('osfrportal.admin.links.groups.delete', $group->grlid) }}')"></a>
                    </td>
                    <td>{{ $group->grlname }}</td>
                    <td>{{ $group->grlsortorder }}</td>
                    <td>{{ $group->parent()->first() ? $group->parent()->first()->grlname : '-' }}</td>
                    <td>{{ $group->grlcollapsed ? 'Раскрыто' : 'Свернуто' }}
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
                    text: "Группа будет удалена!",
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
