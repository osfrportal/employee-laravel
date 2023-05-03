<!-- Кнопка-триггер модального окна -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Добавить полномочие
</button>

<!-- Модальное окно -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-permission-add" action="/submit.action" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавление полномочия</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="rolename" class="form-label">Наименование полномочия</label>
                        <input type="text" class="form-control" id="rolename">
                    </div>
                    <div class="mb-3">
                        <select class="form-select form-select-sm mb-3" id="select2-roles" name="roles[]"
                            multiple="multiple" data-ajax--delay="500"
                            data-placeholder="Выберите роли, в которые будет входить указанное полномочие"
                            data-allow-clear="true" data-language="ru" data-selection-css-class="select2--small"
                            data-dropdown-css-class="select2--small"></select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#select2-roles').select2({
                theme: 'bootstrap-5',
                ajax: {
                    dataType: 'json',
                    url: function(params) {
                        return "{{ route('osfrapi.osfrportal.admin.select2.permissions.roles_all') }}";
                    },
                }
            });
            $('#form-permission-add').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var actionUrl = form.attr('action');
                var method = form.attr('method');
                $.ajax({
                    url: actionUrl,
                    type: method,
                    data: form.serialize(),
                    success: function(data) {
                        alert("Successfully submitted.")
                    },
                    error: function(jqXHR, exception) {
                        alert('Error. ' + jqXHR.responseText);
                    }
                });
            });
        });
    </script>
@endpush
