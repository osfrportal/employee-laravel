@extends('osfrportal::layout')
@section('content')
    @dump($appointment)
    <form method="POST" action="{{ route('osfrportal.admin.persons.appointments.detail', $appointment->aid) }}">
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
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="font-italic text-muted mb-4">
                        Чем меньше число, тем выше в списке
                    </div>
                </div>
                <button class="btn btn-primary btn-submit" type="submit">Сохранить</button>
            </div>
        </div>
    </form>
    @if ($appointment->sfrpersons_count == 0)
        <form method="POST" action="{{ route('osfrportal.admin.persons.appointments.detail', $appointment->aid) }}">
            <input type="hidden" id="aid" name="aid" value="{{ $appointment->ai }}">
            <div class="card mb-4">
                <div class="card-body">
                    <button class="btn btn-danger btn-submit" type="submit">УДАЛИТЬ</button>
                </div>
            </div>
        </form>
    @endif
@endsection
