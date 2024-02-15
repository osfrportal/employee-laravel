editable
<form method="POST" action="{{ route('osfrportal.admin.docs.saveeditable') }}" enctype="multipart/form-data">
    <input type="hidden" name="docid" id="docid" value="{{ $docid ?? '' }}">
    <div class="mb-3">
        <label for="docName" class="form-label">Наименование документа</label>
        <input type="text" class="form-control form-control-sm  @error('docName') is-invalid @enderror"
            id="docName" name="docName" value="{{ old('docName') ?? '' }}" required>
        @error('docName')
            <div id="docNameFeedback" class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group mb-3 has-validation">
        <span class="input-group-text">№</span>
        <input type="text" class="form-control form-control-sm @error('docNumber') is-invalid @enderror"
            placeholder="Номер" id="docNumber" name="docNumber" value="{{ old('docNumber') ?? '' }}" required>

        <span class="input-group-text"> от </span>
        <input type="date" class="form-control form-control-sm @error('docDate') is-invalid @enderror"
            placeholder="Дата" id="docDate" name="docDate" value="{{ old('docDate') ?? '' }}" required>
        <div class="mb-3 has-validation">
            @error('docNumber')
                <div id="docNumberFeedback" class="invalid-feedback">{{ $message }}</div>
            @enderror
            @error('docDate')
                <div id="docDateFeedback" class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
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
