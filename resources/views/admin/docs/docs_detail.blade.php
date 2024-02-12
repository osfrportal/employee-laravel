@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item active">Управление документами</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <a class="btn btn-primary" href="{{ route('osfrportal.admin.docs.all') }}" role="button">К списку</a>
    <hr>
    <div class="card">
        <div class="card-header">
            Карточка документа
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $docData->docName ?? '' }} </h5>
            <div class="card-text">
                @if ($docIsEditable)
                    @include('osfrportal::admin.docs.parts.editableDetailData')
                @else
                    @include('osfrportal::admin.docs.parts.detailData')
                @endif
                <form method="POST" action="{{ route('osfrportal.admin.docs.savedateend') }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="docid" id="docid" value="{{ $docid ?? '' }}">
                    <div class="mb-3 row">
                        <label for="docDateEnd" class="col-sm-2 col-form-label">Дата окончания действия документа:</label>
                        <div class="col-sm-3">
                            <input type="date"
                                class="form-control form-control-sm  @error('docDateEnd') is-invalid @enderror"
                                id="docDateEnd" name="docDateEnd" value="{{ old('docDateEnd') ?? $docData->docDateEnd }}">
                            @error('docDateEnd')
                                <div id="docDateEnd" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-sm btn-success">Сохранить</button>
                                <button type="button" class="btn btn-sm btn-warning" id="btnClearDate">Очистить</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm align-middle table-bordered">
                <thead class="table-light" align="center">
                    <tr>
                        <th scope="col" colspan="6">Файлы</th>
                    </tr>
                    <tr>
                        <th scope="col">Действия</th>
                        <th scope="col">Состояние</th>
                        <th scope="col">Файл</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Дата загрузки</th>
                        <th scope="col">Хэш ГОСТ</th>

                    </tr>
                </thead>
                <tbody align="center">
                    @foreach ($docFiles as $docFile)
                        <tr>
                            <td scope="row">-</td>
                            <td>
                                {{ $docFile->file_enabled === false ? 'Скрыт' : 'Активен' }}
                            </td>
                            <td><a href="@docsfileurl($docFile->file_name)" target="_blank">{{ $docFile->file_name }}</a></td>
                            <td>{{ $docFile->file_description ?? '' }}</td>
                            <td>{{ $docFile->created_at ?? '' }}</td>
                            <td>{{ isset($docFile->file_gosthash) ? 'Да' : 'Нет' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @livewire('osfrportal::uploaddocsfiles', ['docid' => $docid])
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnClearDate').click(function() {
                $('input[id="docDateEnd"]').val('');
            });
        });
    </script>
@endpush
