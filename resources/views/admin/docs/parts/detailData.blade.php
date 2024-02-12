<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">Реквизиты документа:</label>
    <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext"
            value="№ {{ $docData->docNumber ?? '-' }} от {{ $docData->docDate ?? '' }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">Описание документа:</label>
    <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" value="{{ $docData->docDescription ?? '' }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">Тип документа:</label>
    <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" value="{{ $docTypeName ?? '' }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">Группа документа:</label>
    <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" value="{{ $docGroupName ?? '' }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-sm-2 col-form-label">Требуется ознакомление:</label>
    <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext"
            value="@if ($docData->docNeedSign) ДА @else Нет @endif">

    </div>
</div>
<form method="POST" action="{{ route('osfrportal.admin.docs.savedateend') }}" enctype="multipart/form-data">
    <input type="hidden" name="docid" id="docid" value="{{ $docid ?? '' }}">
    <div class="mb-3 row">
        <label for="docDateEnd" class="col-sm-2 col-form-label">Дата окончания действия документа:</label>
        <div class="col-sm-3">
            <input type="date" class="form-control form-control-sm  @error('docDateEnd') is-invalid @enderror"
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
