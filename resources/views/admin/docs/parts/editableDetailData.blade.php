editable
<form method="POST" action="{{ route('osfrportal.admin.docs.saveeditable') }}" enctype="multipart/form-data">
    <input type="hidden" name="docid" id="docid" value="{{ $docid ?? '' }}">
    <div class="mb-3 row">
        <div class="col">
            <button type="submit" class="btn btn-sm btn-success">Сохранить</button>
        </div>
    </div>
</form>
