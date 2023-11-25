@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item">Управление документами</li>
                <li class="breadcrumb-item">Отчеты</li>
                <li class="breadcrumb-item active">Ознакомление по подразделениям</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
<div class="mb-3">
    <label for="js-all-sfrunits-ajax" class="form-label">Подразделения</label>
    @include('osfrportal::admin.docs.reports.select2units')
  </div>
  <div class="mb-3">
    <label for="js-all-sfrdocs-ajax" class="form-label">Документы</label>
    @include('osfrportal::admin.docs.reports.select2docs')
  </div>


@endsection
