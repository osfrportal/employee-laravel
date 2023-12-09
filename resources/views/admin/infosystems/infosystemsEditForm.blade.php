@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">ИС и полномочия</a></li>
                <li class="breadcrumb-item"><a href="#">Управление</a></li>
                <li class="breadcrumb-item active">Добавление/Редактирование</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('osfrportal.admin.infosystems.save') }}">
        <input type="hidden" id="inputIsysName" name="isys_name" value="{{ $infoSystemData->isys_name ?? '' }}">
        <div class="mb-3 row">
            <label for="inputIsysName" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('isys_name') is-invalid @enderror" id="inputIsysName"
                    name="isys_name" value="{{ old('isys_name', $infoSystemData->isys_name ?? '') }}">
                @error('linkname')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <a class="btn btn-primary" href="{{ route('osfrportal.admin.infosystems.index') }}" role="button">Назад</a>
        <input class="btn btn-primary" type="submit" value="Сохранить">
    </form>
@endsection
