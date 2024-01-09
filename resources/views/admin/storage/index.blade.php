@extends('osfrportal::layout')

@section('content')
    <div id="buttons_wrapper" class="mb-3">
        <div class="row">
            <div class="col-6 text-start">
                <a class="btn btn-sm btn-primary" href="#"><i class="ti ti-device-usb icon-size-24"></i>
                    Добавить</a>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-sm btn-outline-primary" href="#"><i
                        class="ti ti-device-desktop-analytics icon-size-24"></i>
                    Сформировать журнал</a>
            </div>
        </div>
    </div>
    <div class="pt-0">
        <table class="table table-sm dataTable no-footer" id="table-storage">
            <thead>
                <tr>
                    <th>Учетный номер</th>
                    <th>Дата постановки на учет</th>
                    <th>Тип носителя</th>
                    <th>Метка категории носителя</th>
                    <th>Заводской или входящий номер</th>
                    <th>Емкость носителя</th>
                    <th>Откуда поступил</th>
                    <th>Работник</th>
                    <th>Отметка о проверке</th>
                    <th>Дата документа о снятии с учета</th>
                    <th>Номер документа о снятии с учета</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
