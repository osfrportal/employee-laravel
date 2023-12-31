<div class="modal fade" id="stampIssueDialog" tabindex="-1" aria-labelledby="stampIssueDialogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-stamp-issue" action="{{ route('osfrportal.admin.stamps.stampissue') }}" method="POST">
                @csrf
                <input type="hidden" id="stampid" name="stampid" />
                <div class="modal-header">
                    <h5 class="modal-title" id="stampIssueDialogModalLabel">Выдача металлической печати работнику</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="js-persons-infosystems-ajax" class="col-form-label">Работник:</label>
                        <select class="form-select form-select-sm mb-3" id="js-persons-infosystems-ajax" name="personid"
                            data-placeholder="Выберите работника" data-allow-clear="true" data-minimum-input-length="4"
                            data-ajax--delay="500" data-language="ru" data-selection-css-class="select2--small"
                            data-dropdown-css-class="select2--small"></select>
                    </div>
                    <div class="mb-3">
                        <label for="stampIssueDate" class="form-label">Дата выдачи (по журналу)</label>
                        <input type="date" class="form-control" id="stampIssueDate" name="stampIssueDate">
                    </div>
                    <div class="mb-3">
                        <label for="stampIssuePaperNumber" class="form-label">Номер по журналу</label>
                        <input type="text" class="form-control" id="stampIssuePaperNumber"
                            name="stampIssuePaperNumber">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Выдать</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var stampIssueDialogModal = document.getElementById('stampIssueDialog')
            stampIssueDialogModal.addEventListener('show.bs.modal', function(event) {
                $('#js-persons-infosystems-ajax').val(null).trigger('change');
                var button = event.relatedTarget
                var recipient = button.getAttribute('data-bs-whatever')
                $('#js-persons-infosystems-ajax').select2({
                    dropdownParent: stampIssueDialogModal,
                    ajax: {
                        dataType: 'json',
                        url: function(params) {
                            var urlroute =
                                '{{ route('osfrapi.osfrportal.admin.select2.persons.search', ':slug') }}';
                            urlroute = urlroute.replace(':slug', params.term);
                            return urlroute;
                        }
                    }
                });
                // Update the modal's content.
                //var modalTitle = stampIssueDialogModal.querySelector('.modal-title')
                //var modalBodyInput = stampIssueDialogModal.querySelector('.modal-body input')

                //modalTitle.textContent = 'New message to ' + recipient
                //modalBodyInput.value = recipient
                //var stampidInput = stampIssueDialogModal.getElementById('stampid');
                //stampidInput.value = recipient;
                $("#stampid").val(recipient);

                $('#form-stamp-issue').submit(function(e) {
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
                                text: "Выдано успешно",
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
