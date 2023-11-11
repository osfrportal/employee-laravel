@extends('osfrportal::layout')
@section('title2')
    <div class="pt-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Администрирование</a></li>
                <li class="breadcrumb-item active">Сертификаты</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="alert alert-info" role="alert">
        Внимание! Загрузка данных для отображения списка может занимать до 3 минут!
    </div>
    <table class="table table-striped table-sm dataTable no-footer" id="table-certs">
        <thead>
            <tr>
                <th>Серийный номер</th>
                <th>Действует до</th>
                <th>Тип сертификата</th>
                <th>Работник</th>
                <th>CN</th>
                <th>ID УНЭП</th>
                <th>Дата отзыва</th>
            </tr>
        </thead>
    </table>
@endsection
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-certs').DataTable({
                ajax: '{{ route('osfrportal.admin.certs.api.all') }}',
                processing: false,
                serverSide: false,
                ordering: true,
                columns: [{
                        data: 'certserial'
                    },
                    {
                        data: 'certvalidto'
                    },
                    {
                        data: 'certtype'
                    },
                    {
                        data: 'sfr_person'
                    },
                    {
                        data: 'CN'
                    },
                    {
                        data: 'certId'
                    },
                    {
                        data: 'revokedate'
                    },
                ],
                columnDefs: [{
                        className: "dt-center",
                        targets: [0, 1, 2, 3, 4, 5, 6]
                    },
                    {
                        targets: 2,
                        orderable: true,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            if (data !== null) {
                                var myArray = Object.values(data);
                                return myArray[1];
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        targets: 3,
                        orderable: true,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            if (data !== null) {
                                return data.psurname + ' ' + data.pname + ' ' + data.pmiddlename;
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        targets: 5,
                        orderable: true,
                        searchable: true,
                    },
                    {
                        targets: 6,
                        orderable: true,
                        searchable: true,
                        render: function(data, type, full, meta) {
                            if (data !== null) {
                                var dateDB = new Date(Date.parse(data.date));
                                var mn = dateDB.getMonth() + 1;
                                var month = mn < 10 ? '0' + mn :
                                    mn;
                                var day = dateDB.getDate() < 10 ? '0' + dateDB.getDate() : dateDB
                                    .getDate();
                                var yr = dateDB.getFullYear();
                                var tm = dateDB.getHours() + ':' + dateDB.getMinutes() + ':' +
                                    dateDB.getSeconds();
                                var newDate = day + '.' + month + '.' + yr + '(' + tm + ')';
                                return newDate;
                            } else {
                                return '';
                            }
                        }
                    },
                ],
            });
        });
    </script>
@endpush
