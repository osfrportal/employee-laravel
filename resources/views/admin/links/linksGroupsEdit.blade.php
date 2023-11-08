@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Ссылки</a></li>
                <li class="breadcrumb-item active">Группы ссылок</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('osfrportal.admin.links.groups.save') }}">
        <input type="hidden" id="inputGrlID" name="grlid" value="{{ $groupData->grlid ?? '' }}">
        <div class="mb-3 row">
            <label for="inputGrlName" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('grlname') is-invalid @enderror" id="inputGrlName"
                    name="grlname" value="{{ old('grlname', $groupData->grlname ?? '') }}">
                @error('grlname')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputGrlSortOrder" class="col-sm-2 col-form-label">Порядок сортировки</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('grlsortorder') is-invalid @enderror"
                    id="inputGrlSortOrder" name="grlsortorder"
                    value="{{ old('grlsortorder', $groupData->grlsortorder ?? '9999') }}">
                @error('grlsortorder')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputGrlCollapsed" class="col-sm-2 col-form-label">Вид отображения</label>
            <div class="col-sm-10">
                <select class="form-select @error('grlcollapsed') is-invalid @enderror" id="inputGrlCollapsed"
                    name="grlcollapsed">
                    <option value="0">Свернуто</option>
                    <option value="1" @selected(old('grlcollapsed', $groupData->grlcollapsed ?? 0))>Раскрыто</option>
                </select>
                @error('grlcollapsed')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputGrlParent" class="col-sm-2 col-form-label">Родительская группа</label>
            <div class="col-sm-10">
                <select class="form-select @error('grlparentid') is-invalid @enderror" id="inputGrlParent"
                    name="grlparentid">
                    <option value="0"></option>
                </select>
                @error('grlparentid')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <a class="btn btn-primary" href="{{ route('osfrportal.admin.links.groups.all') }}" role="button">Назад</a>
        <input class="btn btn-primary" type="submit" value="Сохранить">

    </form>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var jqxhr = $.get(
                    "{{ route('osfrportal.admin.links.api.select2.groups.root', $groupData->grlparentid ?? '') }}",
                    function(groupsdata) {
                        $('#inputGrlParent').select2({
                            placeholder: "Выберите родительскую группу",
                            allowClear: true,
                            data: groupsdata,
                        });
                    })
                .fail(function() {
                    swal({
                        title: "Ошибка!",
                        text: "При получении списка групп произошла ошибка. Сообщите разработчику.",
                        icon: "error",
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        buttons: {
                            confirm: "Закрыть",
                        },
                    });
                });
        });
    </script>
@endpush
