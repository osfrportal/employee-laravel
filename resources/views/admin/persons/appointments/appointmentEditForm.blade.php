@extends('osfrportal::layout')
@section('content')
    <form method="POST" action="{{ route('osfrportal.admin.persons.appointments.detail.save') }}">
        <input type="hidden" id="aid" name="aid" value="{{ $appointment->ai }}">
        <div class="card mb-4">
            <div class="card-header">Редактирование должности</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="mb-1" for="aname">Наименование</label>
                    <input class="form-control form-control-sm" id="aname" type="text"
                        value="{{ $appointment->aname ?? '' }}" disabled readonly>
                    <div class="font-italic text-muted mb-4">
                        Заполняется автоматически из выгрузки 1С
                    </div>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="asortorder">Порядок сортировки:</label>
                    <input class="form-control form-control-sm @error('asortorder') is-invalid @enderror" id="asortorder"
                        name="asortorder" type="text" placeholder="Введите число"
                        value="{{ old('asortorder') ?? ($appointment->asortorder ?? '') }}">
                    @error('asortorder')
                        <div id="asortorderFeedback" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="font-italic text-muted mb-4">
                        Чем меньше число, тем выше в списке
                    </div>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="amop">МОП</label>
                    <select class="form-select form-select-sm @error('amop') is-invalid @enderror" id="amop"
                        name="amop">
                        <option>Выберите...</option>
                        <option value="1" @selected(old('amop', $appointment->amop ?? '') == 1)>Да</option>
                        <option value="0" @selected(old('amop', $appointment->amop ?? '') == 0)>Нет</option>
                    </select>
                    @error('amop')
                        <div id="amopFeedback" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary btn-submit" type="submit">Сохранить</button>
            </div>
        </div>
    </form>

    <div class="card mb-4">
        <div class="card-header">Удаление должности</div>
        <div class="card-body">
            @if ($appointment->sfrpersons_count == 0)
                <form method="POST"
                    action="{{ route('osfrportal.admin.persons.appointments.detail', $appointment->aid) }}">
                    <input type="hidden" id="aid" name="aid" value="{{ $appointment->ai }}">
                    <button class="btn btn-danger btn-submit" type="submit">УДАЛИТЬ</button>
                </form>
            @else
                <div class="font-italic text-muted mb-4">
                    <button class="btn btn-danger">УДАЛЕНИЕ НЕВОЗМОЖНО</button>
                    <br>Количество работников с данной должностью - {{ $appointment->sfrpersons_count }}
                </div>
            @endif
        </div>
    </div>
@endsection
