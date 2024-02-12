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
