@extends('osfrportal::layout')

@section('content')
    <form method="POST" action="{{ route('osfrportal.admin.storage.store') }}">
        @csrf
        <div class="card mb-4">
            <div class="card-header">Добавление устройства хранения</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control form-control-sm @error('stornumber') is-invalid @enderror"
                                id="stornumber" name="stornumber" value="{{ old('stornumber') ?? '' }}">
                            <label for="stornumber">Учетный номер</label>
                            @error('stornumber')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="date"
                                class="form-control form-control-sm @error('stordate') is-invalid @enderror" id="stordate"
                                name="stordate" value="{{ old('stordate') ?? '' }}">
                            <label for="stordate">Дата постановки на учет:</label>
                            @error('stordate')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <select class="form-select form-select-sm mb-3 @error('personid') is-invalid @enderror"
                                id="js-persons-ajax" name="personid" data-placeholder="Выберите работника"
                                data-allow-clear="true" data-minimum-input-length="4" data-ajax--delay="500"
                                data-language="ru" data-selection-css-class="select2--small"
                                data-dropdown-css-class="select2--small"></select>
                            @error('personid')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select name="stortype" id="stortype"
                                class="form-select form-select-sm @error('stortype') is-invalid @enderror">
                                @foreach ($StorageTypes as $storageTypeKey => $storageType)
                                    <option value="{{ $storageTypeKey }}" @selected(old('stortype') == $storageTypeKey)>
                                        {{ $storageType }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="stortype">Тип:</label>
                            @error('stortype')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select name="stormark" id="stormark"
                                class="form-select form-select-sm @error('stormark') is-invalid @enderror">
                                @foreach ($StorageCategoryTypes as $storageCategoryTypeKey => $storageCategoryType)
                                    <option value="{{ $storageCategoryTypeKey }}" @selected(old('stormark') == $storageCategoryTypeKey)>
                                        {{ $storageCategoryType }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="stormark">Метка категории носителя:</label>
                            @error('stormark')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <div class="input-group mb-3 has-validation">
                            <div class="form-floating">
                                <input class="form-control form-control-sm @error('storvolume') is-invalid @enderror"
                                    id="storvolume" name="storvolume" type="text" value="{{ old('storvolume') ?? '' }}">
                                <label for="storvolume">Емкость носителя:</label>
                            </div>
                            <span class="input-group-text">Мегабайт</span>

                            @error('storvolume')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input class="form-control form-control-sm @error('storserial') is-invalid @enderror"
                                id="storserial" name="storserial" type="text" value="{{ old('storserial') ?? '' }}">
                            <label for="storserial">Заводской или входящий номер:</label>
                            @error('storserial')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input class="form-control form-control-sm @error('storarrivedfrom') is-invalid @enderror"
                                id="storarrivedfrom" name="storarrivedfrom" type="text"
                                value="{{ old('storarrivedfrom') ?? '' }}">
                            <label for="storarrivedfrom">Откуда поступил:</label>
                            @error('storarrivedfrom')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">Снятие с учета</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="mb-1" for="stordestroydate">Дата документа о снятии с учета:</label>
                    <input id="stordestroydate" type="date" name="stordestroydate"
                        class="form-control form-control-sm @error('stordestroydate') is-invalid @enderror"
                        value="{{ old('stordestroydate') ?? '' }}" />
                    @error('stordestroydate')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="stordestroydoc">Номер документа о снятии с учета:</label>
                    <input id="stordestroydoc" type="text" name="stordestroydoc"
                        class="form-control form-control-sm @error('stordestroydoc') is-invalid @enderror"
                        value="{{ old('stordestroydoc') ?? '' }}" />
                    @error('stordestroydoc')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
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
