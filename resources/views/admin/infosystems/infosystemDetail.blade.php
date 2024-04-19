@extends('osfrportal::layout')
@section('content')
    <div class="card mb-4 mb-xl-0">
        <div class="card-header">Карточка информационной системы</div>
        <div class="card-body">
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
                                <div class="col">Синхронизация с ИС</div>
                                <div class="col">{{ $infoSystemModel->isys_data->syncWithIS }}</div>
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
@endsection
