@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item">Разделы документов</li>
                <li class="breadcrumb-item active">Добавление/изменение разделов</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('osfrportal.admin.docs.groups.save') }}" enctype="multipart/form-data">
        <div class="row mb-3 align-items-center">
            <label class="col-sm-3 col-form-label" for="group_name">Наименование раздела:</label>
            <div class="col-sm-8">
                <input type="text" name="group_name" id="group_name"
                    class="form-control @error('group_name') is-invalid @enderror"
                    value="{{ old('group_name', $edit_values['group_name']) ?? '' }}">
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-success btn-submit">Сохранить</button> <a class="btn btn-danger btn-reset"
                href="{{ route('osfrportal.admin.docs.groups.all') }}" role="button">К списку</a>
        </div>
    </form>
@endsection
