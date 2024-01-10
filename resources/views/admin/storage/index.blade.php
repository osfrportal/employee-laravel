@extends('osfrportal::layout')

@section('content')
    <div id="buttons_wrapper" class="mb-3">
        <div class="row">
            <div class="col-6 text-start">
                <a class="btn btn-sm btn-primary" href="{{ route('osfrportal.admin.storage.create') }}"><i
                        class="ti ti-device-usb icon-size-24"></i>
                    Добавить</a>
            </div>
            <div class="col-6 text-end">
                <a class="btn btn-sm btn-outline-primary" href="#"><i
                        class="ti ti-device-desktop-analytics icon-size-24"></i>
                    Сформировать журнал</a>
            </div>
        </div>
    </div>
    <div class="pt-0">
        <table class="table table-sm dataTable no-footer" id="table-storage">
            <thead>
                <tr>
                    <th>Учетный номер</th>
                    <th>Дата постановки на учет</th>
                    <th>Тип носителя</th>
                    <th>Метка категории носителя</th>
                    <th>Заводской или входящий номер</th>
                    <th>Емкость носителя</th>
                    <th>Откуда поступил</th>
                    <th>Работник</th>
                    <th>Отметка о проверке</th>
                    <th>Дата документа о снятии с учета</th>
                    <th>Номер документа о снятии с учета</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#table-storage').DataTable({
                dom: '<"top"flp<"clear">>rt<"bottom"ip<"clear">>',
                processing: true,
                serverSide: true,
                ordering: true,
                order: [
                    [0, 'desc'],
                ],
                ajax: "{{ route('osfrportal.admin.storage.index') }}",
                columns: [{
                        data: 'stornumber',
                    },
                    {
                        data: 'stordate',
                        render: DataTable.render.date(),
                    },
                    {
                        data: 'stortype',
                        render: function(data, type, full, meta) {
                            let arr = Object.values(data);
                            return arr[1];
                        }
                    },
                    {
                        data: 'stormark',
                        render: function(data, type, full, meta) {
                            let arr = Object.values(data);
                            return arr[1];
                        }
                    },
                    {
                        data: 'storserial',
                    },
                    {
                        data: 'storvolume',
                    },
                    {
                        data: 'storarrivedfrom',
                    },
                    {
                        data: 'person',
                        render: function(data, type, full, meta) {
                            return data.psurname + ' ' + data.pname + ' ' + data.pmiddlename;
                        }
                    },
                ],
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    orderable: true,
                    searchable: true,
                    className: 'dt-body-center dt-head-center',
                }, ],
            });
        });
    </script>
@endpush
