@extends('osfrportal::layout')

@section('content')
    <form method="POST" action="{{ route('osfrportal.admin.storage.store') }}">
        @csrf
        <div class="card mb-4">
            <div class="card-header">Добавление устройства хранения</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="mb-1" for="stortype">Тип:</label>
                    <select name="stortype" id="stortype"
                        class="form-control form-control-sm @error('stortype') is-invalid @enderror">
                        @foreach ($StorageTypes as $storageTypeKey => $storageType)
                            <option value="{{ $storageTypeKey }}" @selected(old('stortype') == $storageTypeKey)>
                                {{ $storageType }}
                            </option>
                        @endforeach
                    </select>
                    @error('stortype')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="stormark">Метка категории носителя:</label>
                    <select name="stormark" id="stormark"
                        class="form-control form-control-sm @error('stormark') is-invalid @enderror">
                        @foreach ($StorageCategoryTypes as $storageCategoryTypeKey => $storageCategoryType)
                            <option value="{{ $storageCategoryTypeKey }}" @selected(old('stormark') == $storageCategoryTypeKey)>
                                {{ $storageCategoryType }}
                            </option>
                        @endforeach
                    </select>
                    @error('stormark')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">Работник</div>
            <div class="card-body">
                <select class="form-select form-select-sm mb-3" id="js-persons-ajax" name="personid"
                    data-placeholder="Выберите работника" data-allow-clear="true" data-minimum-input-length="4"
                    data-ajax--delay="500" data-language="ru" data-selection-css-class="select2--small"
                    data-dropdown-css-class="select2--small"></select>
            </div>
        </div>
        <div class="mb-3">
            <input class="btn btn-primary" type="submit" value="Добавить">
        </div>
    </form>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#js-persons-ajax').select2({
                ajax: {
                    dataType: 'json',
                    url: function(params) {
                        var urlroute =
                            '{{ route('osfrapi.osfrportal.admin.select2.persons.search', ':slug') }}';
                        urlroute = urlroute.replace(':slug', params.term);
                        return urlroute;
                    }
                }
            });
        });
    </script>
@endpush
