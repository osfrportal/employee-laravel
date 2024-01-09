@extends('osfrportal::layout')

@section('content')
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
                    <th>Дата документа о снятии с учета</th>
                    <th>Номер документа о снятии с учета</th>
                    <th>Работник</th>
                    <th>Отметка о проверке</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
