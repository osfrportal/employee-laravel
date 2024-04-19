@extends('osfrportal::layout')
@section('content')
    <div class="card mb-4 mb-xl-0">
        <div class="card-header">Информационная система</div>
        <div class="card-body">
            <div class="row">
                <div class="col">Наименование ИС</div>
                <div class="col">{{ $infoSystemModel->isys_name }}</div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Данные ИС</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">Синхронизация с ИС</div>
                                <div class="col">{{ $infoSystemModel->infoSystemModel->syncWithIS }}</div>
                            </div>
                            <div class="row">
                                <div class="col">controllerNameSync</div>
                                <div class="col">{{ $infoSystemModel->infoSystemModel->controllerNameSync ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
