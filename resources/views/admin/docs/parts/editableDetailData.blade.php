editable
<form method="POST" action="{{ route('osfrportal.admin.docs.saveeditable') }}" enctype="multipart/form-data">
    <input type="hidden" name="docid" id="docid" value="{{ $docid ?? '' }}">
    <div class="mb-3">
        <label for="docName" class="form-label">Наименование документа</label>
        <input type="text" class="form-control form-control-sm  @error('docName') is-invalid @enderror"
            id="docName" name="docName" value="{{ old('docName') ?? ($docData->docName ?? '') }}" required>
        @error('docName')
            <div id="docNameFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3 has-validation">
        <span class="input-group-text">№</span>
        <input type="text" class="form-control form-control-sm @error('docNumber') is-invalid @enderror"
            placeholder="Номер" id="docNumber" name="docNumber"
            value="{{ old('docNumber') ?? ($docData->docNumber ?? '') }}" required>

        <span class="input-group-text"> от </span>
        <input type="date" class="form-control form-control-sm @error('docDate') is-invalid @enderror"
            placeholder="Дата" id="docDate" name="docDate" value="{{ old('docDate') ?? ($docData->docDate ?? '') }}"
            required>
        <div class="mb-3 has-validation">
            @error('docNumber')
                <div id="docNumberFeedback" class="invalid-feedback">{{ $message }}</div>
            @enderror
            @error('docDate')
                <div id="docDateFeedback" class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label for="docType" class="form-label">Тип документа</label>
        <select class="form-select form-select-sm @error('docType') is-invalid @enderror" id="docType" name="docType"
            data-ajax--delay="500" data-placeholder="Выберите тип документа" data-allow-clear="true" data-language="ru"
            data-selection-css-class="select2--small" data-dropdown-css-class="select2--small"
            data-minimum-input-length="0">
        </select>
        @error('docType')
            <div id="docTypeFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="docGroup" class="form-label">Раздел (группа) документа</label>
        <select class="form-select form-select-sm @error('docGroup') is-invalid @enderror" id="docGroup"
            name="docGroup" data-ajax--delay="500" data-placeholder="Выберите группу документа" data-allow-clear="true"
            data-language="ru" data-selection-css-class="select2--small" data-dropdown-css-class="select2--small"
            data-minimum-input-length="0">
        </select>
        @error('docGroup')
            <div id="docGroupFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="docDescription" class="form-label">Описание документа</label>
        <textarea class="form-control @error('docDescription') is-invalid @enderror" id="docDescription" name="docDescription"
            rows="3">{{ old('docDescription') ?? ($docData->docDescription ?? '') }}</textarea>
        @error('docDescription')
            <div id="docDescriptionFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="mb-1" for="docNeedSign">Ознакомление работников</label>
        <select class="form-select form-select-sm @error('docNeedSign') is-invalid @enderror" id="docNeedSign"
            name="docNeedSign">
            <option>Выберите...</option>
            <option value="1" @selected(old('docNeedSign' ?? ($docData->docNeedSign ?? '')) == 1)>Требуется</option>
            <option value="0" @selected(old('docNeedSign' ?? ($docData->docNeedSign ?? '')) == 0)>Не требуется</option>
        </select>
        @error('docNeedSign')
            <div id="docNeedSignFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 row">
        <div class="col">
            <button type="submit" class="btn btn-sm btn-success">Сохранить</button>
        </div>
    </div>
</form>

<form method="POST" action="{{ route('osfrportal.admin.docs.deleteeditable') }}" enctype="multipart/form-data">
    <input type="hidden" name="docid" id="docid" value="{{ $docid ?? '' }}">
    <div class="mb-3 row">
        <div class="col">
            <button type="submit" class="btn btn-sm btn-danger">УДАЛИТЬ ДОКУМЕНТ И ФАЙЛЫ</button>
        </div>
    </div>
</form>
