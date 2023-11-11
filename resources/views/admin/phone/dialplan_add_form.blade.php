@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item"><a href="#">Телефонный справочник</a></li>
                <li class="breadcrumb-item active">Добавление/Изменение DialPlan</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    @if ($errors->any())
        <!-- div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
                </ul>
            </div -->
    @endif
    <form method="POST" action="{{ route('osfrportal.admin.phone.dialplan.save') }}" enctype="multipart/form-data">
        <div class="row mb-3 align-items-center">
            <label class="col-sm-2 col-form-label" for="email_ext">Начало диапазона:</label>
            <div class="col-sm-10">
                <input type="text" name="dialplan_dpnumstart" id="dialplan_dpnumstart"
                    class="form-control @error('dialplan_dpnumstart') is-invalid @enderror"
                    value="{{ old('dialplan_dpnumstart', $edit_values['dpnumstart']) ?? '' }}">
            </div>
        </div>
        <div class="row mb-3 align-items-center">
            <label class="col-sm-2 col-form-label" for="email_ext">Конец диапазона:</label>
            <div class="col-sm-10">
                <input type="text" name="dialplan_dpnumend" id="dialplan_dpnumend"
                    class="form-control @error('dialplan_dpnumend') is-invalid @enderror"
                    value="{{ old('dialplan_dpnumend', $edit_values['dpnumend']) ?? '' }}">
            </div>
        </div>
        <div class="row mb-3 align-items-center">
            <label class="col-sm-2 col-form-label" for="email_ext">Адрес:</label>
            <div class="col-sm-10">
                <select class="form-select form-select-sm @error('addrid') is-invalid @enderror"
                    aria-label=".form-select-sm example" id="addrid" name="addrid">>
                    <option>&nbsp;</option>
                    @if ($addresses_collection->count())
                        @foreach ($addresses_collection as $address)
                            <option value="{{ $address['addrid'] }}" @selected($edit_values['addrid'] == $address['addrid'])>
                                {{ $address['paddress'] ?? '' }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-success btn-submit">Сохранить</button> <a class="btn btn-danger btn-reset"
                href="{{ route('osfrportal.admin.phone.dialplan') }}" role="button">К списку</a>
        </div>
    </form>
@endsection
