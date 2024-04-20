@extends('osfrportal::layout')
@section('content')
    <div class="card mb-4 mb-xl-0">
        <div class="card-header">Карточка информационной системы</div>
        <div class="card-body">
            <form method="POST" action="#" id="form{{ $infoSystemModel->isysid }}">
                <input type="hidden" id="isysid" name="isysid" value="{{ $infoSystemModel->isysid }}">
                <div class="row">
                    <div class="col">
                        <label for="isys_name" class="form-label">Наименование ИС</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-sm  @error('isys_name') is-invalid @enderror"
                            id="isys_name" name="isys_name"
                            value="{{ old('isys_name') ?? ($infoSystemModel->isys_name ?? '') }}" required>
                        @error('isys_name')
                            <div id="isys_nameFeedback" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-4">
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Данные ИС</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label class="mb-1" for="syncWithIS">Синхронизация с ИС</label>
                                    </div>
                                    <div class="col">
                                        <select class="form-select form-select-sm @error('syncWithIS') is-invalid @enderror"
                                            id="syncWithIS" name="syncWithIS">
                                            <option>Выберите...</option>
                                            <option value="1" @selected(old('syncWithIS', (bool) $infoSystemModel->isys_data->syncWithIS) == 1)>Включено</option>
                                            <option value="0" @selected(old('syncWithIS', (bool) $infoSystemModel->isys_data->syncWithIS) == 0)>Не требуется</option>
                                        </select>
                                        @error('syncWithIS')
                                            <div id="syncWithISFeedback" class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="controllerNameSync" class="form-label">Имя контроллера для
                                            синхронизации</label>
                                    </div>
                                    <div class="col">
                                        <input type="text"
                                            class="form-control form-control-sm  @error('controllerNameSync') is-invalid @enderror"
                                            id="controllerNameSync" name="controllerNameSync"
                                            value="{{ old('controllerNameSync') ?? ((string) $infoSystemModel->isys_data->controllerNameSync ?? '') }}">
                                        @error('controllerNameSync')
                                            <div id="controllerNameSyncFeedback" class="invalid-feedback">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-4">
                        <input class="btn btn-primary" type="submit" value="Сохранить">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col mt-4">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Полномочия информационной системы
                            ({{ $infoSystemModel->roles()->count() }})</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Действия</th>
                                        <th scope="col">Наименование полномочия</th>
                                        <th scope="col">Создано</th>
                                        <th scope="col">Обновлено</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($infoSystemModel->roles as $isRole)
                                        <tr>
                                            <th scope="row">
                                                <a href="#{{ $isRole->iroleid }}" class="text-decoration-none"
                                                    title="Редактирование"><i class="ti ti-edit icon-size-16"></i></a>
                                                <a href="#{{ $isRole->iroleid }}" class="icon-link link-underline-opacity-0"
                                                    title="Удаление"><i class="ti ti-x icon-size-16"></i></a>
                                            </th>
                                            <td>{{ $isRole->irole_name }}</td>
                                            <td>{{ $isRole->created_at }}</td>
                                            <td>{{ $isRole->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
