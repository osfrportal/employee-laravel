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
    <form method="POST" action="{{ route('osfrportal.admin.docs.reports.byunits') }}">
        @csrf
        <div class="mb-3">
            <label for="js-all-sfrunits-ajax" class="form-label">Подразделения</label>
            @include('osfrportal::admin.docs.reports.select2units')
            <div class="form-text">Если не выбрано подразделение - отбор идет по всем подразделениям.</div>
        </div>
        <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="withChildUnits" name="withChildUnits"
                    value="1">
                <label class="form-check-label" for="withChildUnits">Включая подчиненные подразделения</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="withoutAppMOP" name="withoutAppMOP"
                    value="1">
                <label class="form-check-label" for="withoutAppMOP">Не включать должности МОП (младший обслуживающий
                    персонал) в отчет</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="js-all-sfrdocs-ajax" class="form-label">Документы</label>
            @include('osfrportal::admin.docs.reports.select2docs')
            <div class="form-text">Если не выбран документ - отбор идет по всем документам.</div>
        </div>

        <button type="submit" class="btn btn-primary">Сформировать ведомость</button>
    </form>
@endsection
