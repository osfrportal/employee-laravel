@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">ИС и полномочия</a></li>
                <li class="breadcrumb-item"><a href="#">Управление</a></li>
                <li class="breadcrumb-item active">Добавление ролей для ИС</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('osfrportal.admin.infosystems.roles.save') }}">
        <input type="hidden" id="iroleid" name="iroleid" value="{{ old('iroleid', Str::uuid()) }}">
        <div class="mb-3 row">
            <label for="irole_name" class="col-sm-2 col-form-label">Наименование роли</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('irole_name') is-invalid @enderror" id="irole_name"
                    name="irole_name" value="{{ old('irole_name') }}">
                @error('irole_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="js-all-isysid-ajax" class="col-sm-2 col-form-label">Информационная система</label>
            <div class="col-sm-10">
                <select class="form-select form-select-sm mb-3  @error('isysid') is-invalid @enderror"
                    id="js-all-isysid-ajax" name="isysid" data-placeholder="Информационная система"
                    data-minimum-input-length="0" data-selection-css-class="select2--small"
                    data-dropdown-css-class="select2--small"></select>
                @error('isysid')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <a class="btn btn-primary" href="{{ route('osfrportal.admin.infosystems.index') }}" role="button">Назад</a>
        <input class="btn btn-primary" type="submit" value="Сохранить">
    </form>
@endsection
@push('footer-scripts')
    <script type="module">
        $(document).ready(function() {

            $.ajax({
                url: "{{ route('osfrapi.osfrportal.admin.select2.infosystems.allgrouped') }}",
                dataType: 'json',
                success: function(json) {
                    $('#js-all-isysid-ajax').select2({
                        data: json.results,
                    });
                    @if (!empty(old('isysid')))
                        var urlDetailed =
                            '{{ route('osfrapi.osfrportal.admin.select2.infosystems.detail.byid', ':slug') }}';
                        urlDetailed = urlDetailed.replace(':slug', '{{ old('isysid', '') }}');
                        // Fetch the preselected item, and add to the control
                        var isysidSelect = $('#js-all-isysid-ajax');
                        $.ajax({
                            dataType: 'json',
                            url: urlDetailed
                        }).then(function(data) {
                            console.log(data.results);
                            console.log(data.results[0].text);
                            console.log(data.results[0].id);
                            // create the option and append to Select2
                            var option = new Option(data.results[0].text, data.results[0].id, true,
                                true);
                            isysidSelect.append(option).trigger('change');

                            // manually trigger the `select2:select` event
                            isysidSelect.trigger({
                                type: 'select2:select',
                                params: {
                                    data: data.results
                                }
                            });
                        });
                    @endif
                }
            });
        });
    </script>
@endpush
