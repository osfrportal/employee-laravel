<script type="text/javascript" src="{{ asset('osfrportal/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/jquery.inputmask.min.js') }}"></script>

<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script
    src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sl-1.6.2/sr-1.2.2/datatables.min.js">
</script>
<script type="text/javascript">
    //default values for DataTables
    $.extend($.fn.dataTable.defaults, {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ru.json',
        },
        ordering: false,
        pageLength: 30,
        lengthMenu: [
            [30, 100, 200, -1],
            [30, 100, 200, 'Все записи'],
        ],
        pagingType: 'numbers',
        serverSide: false,
        processing: false,
        dataSrc: 'data',
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript" src="{{ asset('osfrportal/js/btn-back-to-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/inputmask.binding.js') }}"></script>
@stack('footer-scripts')
@stack('scripts')
