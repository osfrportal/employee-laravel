<div class="modal fade" id="stampReturnDialog" tabindex="-1" aria-labelledby="stampReturnDialogModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-stamp-return" action="{{ route('osfrportal.admin.stamps.stampreturn') }}" method="POST">
                @csrf
                <input type="hidden" id="rstampid" name="stampid" />
                <input type="hidden" id="rstampjournalid" name="stampjournalid" />
                <div class="modal-header">
                    <h5 class="modal-title" id="stampReturnDialogModalLabel">Возврат металлической печати</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="mb-3">
                        <label for="stampReturnDate" class="form-label">Дата возврата (по журналу)</label>
                        <input type="date" class="form-control" id="stampReturnDate" name="stampReturnDate">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Принять</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var stampReturnDialogModal = document.getElementById('stampReturnDialog')
            stampReturnDialogModal.addEventListener('show.bs.modal', function(event) {
                var buttonReturn = event.relatedTarget
                var recipientReturn = buttonReturn.getAttribute('data-bs-return-stampid')
                var recipientJournalID = buttonReturn.getAttribute('data-bs-return-journalid')

                $("#rstampid").val(recipientReturn);
                $("#rstampjournalid").val(recipientJournalID);

                $('#form-stamp-return').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var actionUrl = form.attr('action');
                    var method = form.attr('method');
                    $.ajax({
                        url: actionUrl,
                        type: method,
                        data: form.serialize(),
                        success: function(response) {
                            var link =
                                "{{ route('osfrportal.admin.stamps.all') }}";
                            swal({
                                text: "Принято успешно",
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
            })
        });
    </script>
@endpush
