<div>
    <div class="card mb-3">
        <div class="card-header">
            Добавление файлов
        </div>
        <div class="card-body">
            <form wire:submit.prevent="uploadDocs" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="file" class="form-control form-control-sm @error('docFileName') is-invalid @enderror"
                        id="docFileName" wire:model="docFileName">
                    @error('docFileName')
                        <div id="docFileNameFeedback" class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="docFileDescription">Описание файла</label>
                    <input type="text"
                        class="form-control form-control-sm @error('docFileDescription') is-invalid @enderror"
                        id="docFileDescription" wire:model.live="docFileDescription">
                    @error('docFileDescription')
                        <div id="docFileDescriptionFeedback" class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit" wire:loading.attr="disabled"
                    wire:offline.attr="disabled">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" wire:loading
                        wire:target="docFileName"></span>
                    Загрузить
                </button>
            </form>
        </div>
    </div>
</div>
