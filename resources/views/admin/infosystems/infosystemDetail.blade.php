@extends('osfrportal::layout')
@section('content')
    <div class="card mb-4 mb-xl-0">
        <div class="card-header">Карточка информационной системы</div>
        <div class="card-body">
            <form method="POST" action="#">
                <div class="row">
                    <div class="col">Наименование ИС</div>
                    <div class="col">{{ $infoSystemModel->isys_name }}</div>
                </div>
                <div class="row">
                    <div class="col mt-4">
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Данные ИС</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col"><label class="mb-1" for="syncWithIS">Синхронизация с ИС</label>
                                    </div>
                                    <div class="col">
                                        <select class="form-select form-select-sm @error('syncWithIS') is-invalid @enderror"
                                            id="syncWithIS" name="syncWithIS">
                                            <option>Выберите...</option>
                                            <option value="1" @selected(old('syncWithIS', $infoSystemModel->isys_data->syncWithIS ?? '') == 1)>Включено</option>
                                            <option value="0" @selected(old('syncWithIS', $infoSystemModel->isys_data->syncWithIS ?? '') == 0)>Не требуется</option>
                                        </select>
                                        @error('syncWithIS')
                                            <div id="syncWithIS" class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @if ($infoSystemModel->isys_data->syncWithIS === true)
                                    <div class="row">
                                        <div class="col">controllerNameSync</div>
                                        <div class="col">@dump($infoSystemModel->isys_data)</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input class="btn btn-primary" type="submit" value="Сохранить">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col mt-4">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Полномочия информационной системы</div>
                        <div class="card-body">
                            <div class="row">
                                1
                            </div>
                            <div class="row">
                                2
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
