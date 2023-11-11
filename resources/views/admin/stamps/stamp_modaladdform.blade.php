<!-- Кнопка-триггер модального окна -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Добавить печать
</button>

<!-- Модальное окно -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-stamp-add" action="{{ route('osfrportal.admin.stamps.stampsave') }}" method="POST">
                @csrf
                <input type="hidden" id="estampid" name="stampid" />
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавление печати</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="stampnumber" class="form-label">Номер печати</label>
                        <input type="text" class="form-control" id="stampnumber" name="stampnumber">
                    </div>
                    <div class="mb-3">
                        <label for="stampdescription" class="form-label">Описание печати</label>
                        <input type="text" class="form-control" id="stampdescription" name="stampdescription">
                    </div>
                    <div class="mb-3">
                        <label for="stampdestruct_at" class="form-label">Дата уничтожения</label>
                        <input type="date" class="form-control" id="stampdestruct_at" name="stampdestruct_at">
                    </div>
                    <div class="mb-3">
                        <label for="stampdestructdoc" class="form-label">Реквизиты документа об уничтожении</label>
                        <input type="text" class="form-control" id="stampdestructdoc" name="stampdestructdoc">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var staticBackdropModal = document.getElementById('staticBackdrop');
            staticBackdropModal.addEventListener('show.bs.modal', function(event) {
                var buttonEdit = event.relatedTarget
                var stampID = buttonEdit.getAttribute('data-bs-edit-stampid')
                var stampNum = buttonEdit.getAttribute('data-bs-edit-stampnum')
                var stampDesc = buttonEdit.getAttribute('data-bs-edit-stampdescr')
                var stampDestructAt = buttonEdit.getAttribute('data-bs-edit-stampdestrat')
                var stampDestructDoc = buttonEdit.getAttribute('data-bs-edit-stampdestrdoc')
                $("#estampid").val(stampID);
                $("#stampnumber").val(stampNum);
                if (stampNum !== null) {
                    $("#staticBackdropLabel").text('Редактирование записи');
                    $("#stampnumber").prop('readonly', true);
                } else {
                    $("#stampnumber").prop('readonly', false);
                }
                $("#stampdescription").val(stampDesc);
                $("#stampdestruct_at").val(stampDestructAt);
                $("#stampdestructdoc").val(stampDestructDoc);
            })
            //@todo: Переписать на sweetalert
            $('#form-stamp-add').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var actionUrl = form.attr('action');
                var method = form.attr('method');
                $.ajax({
                    url: actionUrl,
                    type: method,
                    data: form.serialize(),
                    success: function(response) {
                        var link = "{{ route('osfrportal.admin.stamps.all') }}";
                        swal({
                            text: "Сохранено успешно",
                            icon: "success",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            buttons: {
                                confirm: "Закрыть",
                            },
                        }).then((value) => {
                            if (value) {
                                $(location).attr('href', link);
                            }
                        });
                        //alert(response.message);

                    },
                    error: function(jqXHR, exception) {
                            var errors = jqXHR.responseJSON;
                            var errorsSwal = '';
                            $.each(errors['message'], function(key, value) {
                                errorsSwal += value + '\r\n';
                            });
                            swal({
                                title: "Ошибки при заполнении!",
                                text: errorsSwal,
                                icon: "error",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                                buttons: {
                                    confirm: "Закрыть",
                                },
                            })
                        }
                });
            });
        });
    </script>
@endpush
