@extends('osfrportal::layout')

@section('content')
    create form
    <div class="container">
        <form method="POST" action="{{ route('osfrportal.admin.storage.store') }}">
            @csrf
            <div class="card mb-4">
                <div class="card-header">Добавление криптосредства</div>
                <div class="card-body">
                    <label class="mb-1" for="stortype">Тип криптосредства:</label>
                    <select name="stortype" id="stortype"
                        class="form-control form-control-sm @error('stortype') is-invalid @enderror">
                        <option value="{{ Osfrportal\OsfrportalLaravel\Enums\StorageTypesEnum::NONE()->value }}"
                            @selected(old('stortype') == Osfrportal\OsfrportalLaravel\Enums\StorageTypesEnum::NONE())>
                            {{ Osfrportal\OsfrportalLaravel\Enums\StorageTypesEnum::NONE()->label }}
                        </option>
                    </select>
                    @error('stortype')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Добавить">
            </div>
        </form>
    </div>
@endsection
