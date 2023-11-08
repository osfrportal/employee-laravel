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
    <form method="POST" action="{{ route('osfrportal.admin.links.save') }}">
        <input type="hidden" id="inputLinkID" name="linkid" value="{{ $linkData->linkid ?? '' }}">
        <div class="mb-3 row">
            <label for="inputLinkName" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('linkname') is-invalid @enderror" id="inputLinkName"
                    name="linkname" value="{{ old('linkname', $linkData->linkname ?? '') }}">
                @error('linkname')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputLinkUrl" class="col-sm-2 col-form-label">URL</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('linkurl') is-invalid @enderror" id="inputLinkUrl"
                    name="linkurl" value="{{ old('linkurl', $linkData->linkurl ?? '') }}">
                @error('linkurl')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputLinkSortOrder" class="col-sm-2 col-form-label">Порядок сортировки</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('linksortorder') is-invalid @enderror"
                    id="inputLinkSortOrder" name="linksortorder"
                    value="{{ old('linksortorder', $linkData->linksortorder ?? '9999') }}">
                @error('linksortorder')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputLinkShowLeftMenu" class="col-sm-2 col-form-label">Показать слева в основном меню</label>
            <div class="col-sm-10">
                <select class="form-select @error('linkshowinleftmenu') is-invalid @enderror" id="inputLinkShowLeftMenu"
                    name="linkshowinleftmenu">
                    <option value="0" @selected(old('linkshowinleftmenu', true))>Нет</option>
                    <option value="1" @selected(old('linkshowinleftmenu', $linkData->linkshowinleftmenu ?? ''))>Да</option>
                </select>
                @error('linkshowinleftmenu')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputLinkGroup" class="col-sm-2 col-form-label">Группа</label>
            <div class="col-sm-10">
                <select class="form-select @error('linksgroup') is-invalid @enderror" id="inputLinkGroup"
                    name="linksgroup[]">
                    <option></option>
                </select>
                @error('linksgroup')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <a class="btn btn-primary" href="{{ route('osfrportal.admin.links.all') }}" role="button">Назад</a>
        <input class="btn btn-primary" type="submit" value="Сохранить">

    </form>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var jqxhr = $.get("{{ route('osfrportal.admin.links.api.select2.groups.all', $linkGroupID) }}",
                    function(groupsdata) {
                        $('#inputLinkGroup').select2({
                            placeholder: "Выберите группу",
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
