@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item">Типы документов</li>
                <li class="breadcrumb-item active">Добавление/изменение</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('osfrportal.admin.docs.types.save') }}" enctype="multipart/form-data">
        <div class="row mb-3 align-items-center">
            <label class="col-sm-3 col-form-label" for="type_name">Наименование типа:</label>
            <div class="col-sm-8">
                <input type="text" name="type_name" id="type_name"
                    class="form-control @error('type_name') is-invalid @enderror"
                    value="{{ old('type_name', $edit_values['type_name']) ?? '' }}">
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-success btn-submit">Сохранить</button> <a class="btn btn-danger btn-reset"
                href="{{ route('osfrportal.admin.docs.types.all') }}" role="button">К списку</a>
        </div>
    </form>
@endsection
