@extends('osfrportal::layout')
@section('title', 'Телефонный справочник')
@section('content')
    <div class="table-responsive">
        {{-- <table class="table table-striped table-bordered table-sm dataTable" id="table_phones" style="width: 100%;"> --}}
        <table class="table table-striped table-bordered table-sm" id="table_phones" style="width: 100%;">
            <thead class="align-middle text-center">
                <tr>
                    <th>&nbsp;</th>
                    <th>Подразделение</th>
                    <th>Телефон (ВТС)</th>
                    <th>Телефон (городской)</th>
                    <th>Кабинет</th>
                    <th>Адреса (почтовый/электронный)</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('footer-scripts')
    <script type="module">
        function checkEmptyOrNull(data) {
            if ((data === null) || (data == '----') || (data == '-----')) {
                return ' ';
            } else {
                return data;
            }
        };

        function returnEmailLink(data) {
            if ((data === null) || (data == '----') || (data == '-----')) {
                return ' ';
            } else {
                return '<a href="mailto:' + data + '">' + data + '</a>';
            }
        };
        var table_phones = $('#table_phones').DataTable({
            "ordering": false,
            "lengthChange": false,
            "paging": false,
            "pageLength": -1,
            "lengthMenu": [
                [-1],
                ['Все записи'],
            ],
            "language": {
                "url": "{{ asset('osfrportal/lang/datatables-ru.json') }}"
            },
            "pagingType": 'numbers',
            "initComplete": function() {
                var popoverTriggerList = Array.prototype.slice.call(document.querySelectorAll(
                    '[data-bs-toggle="popover"]'))
                var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl)
                })
            },
            ajax: {
                url: '{{ route('osfrapi.osfrportal.phone.all') }}',
                cache: true,
            },
            serverSide: false,
            processing: false,
            columnDefs: [{
                    className: "align-middle text-center",
                    targets: [0, 2, 3, 4, 5, 6]
                },
                {
                    className: "align-middle",
                    targets: [1]
                }
            ],
            rowGroup: {
                dataSrc: ['contactdata_unit_parent_name', 'contactdata_unit_name'],
                emptyDataGroup: null,
                //className: 'display-unit-name',

            },

            columns: [{
                    data: 'contactdata_person.persondata_fullname',
                    render: function(data, type, row) {
                        var outdata = '<strong>' + data + '</strong>' + '<br>' + row.contactdata_person
                            .persondata_appointment;
                        if (!!row.contactdata_person.persondata_vacation) {
                            return outdata + '<br>' + '<strong><em>' + 'Отпуск по ' + row.contactdata_person
                                .persondata_vacation_end + '</em></strong>';
                        } else if (!!row.contactdata_person.persondata_absence_end) {
                            var popover_data_start =
                                '<span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Командировка, отпуск без сохранения зп и т.д.">';
                            var popover_data_end = '</span>';
                            return outdata + '<br>' + popover_data_start + '<strong><em>' +
                                'Отсутствие по ' + row
                                .contactdata_person.persondata_absence_end + '</em></strong>' +
                                popover_data_end;
                        } else {
                            return outdata;
                        }
                    },
                    name: 'contactdata_person_fullname',
                    orderable: false,
                    searchable: true,
                },
                {
                    data: 'contactdata_unit_name',
                    name: 'contactdata_unit_name',
                    visible: false,
                    orderable: false,
                    searchable: true
                },

                {
                    data: 'contactdata_phone_data.phone_internal',
                    render: function(data, type, row) {
                        return checkEmptyOrNull(data);
                    },
                    name: 'contactdata_phone_internal',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'contactdata_phone_data.phone_external',
                    render: function(data, type, row) {
                        return checkEmptyOrNull(row.contactdata_phone_data.areacode) + ' ' +
                            checkEmptyOrNull(data);
                    },
                    name: 'contactdata_phone_external',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'contactdata_phone_data.room',
                    render: function(data, type, row) {
                        return checkEmptyOrNull(data);
                    },
                    name: 'contactdata_room',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'contactdata_phone_data.address',
                    render: function(data, type, row) {
                        if (!!row.contactdata_person.persondata_dekret_end) {
                            return '<strong><em>' + 'Отпуск по уходу за ребенком<br>(по ' + row
                                .contactdata_person.persondata_dekret_end + ')</em></strong>';
                        } else {
                            return checkEmptyOrNull(data) + '<br>' + returnEmailLink(row
                                .contactdata_phone_data.email_ext);
                        }
                    },
                    name: 'contactdata_address',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'contactdata_unit_name_always',
                    name: 'contactdata_unit_name_always',
                    visible: false,
                    orderable: false,
                    searchable: true
                },
            ]
        });
    </script>
@endpush
