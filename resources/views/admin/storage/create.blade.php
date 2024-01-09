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
        <div class="mb-3">
            <input class="btn btn-primary" type="submit" value="Добавить">
        </div>
    </form>
@endsection
