<script type="text/javascript" src="{{ asset('osfrportal/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/jquery.inputmask.min.js') }}"></script>
<script src="https://unpkg.com/@popperjs/core"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/select2/select2.min.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript" src="{{ asset('osfrportal/js/datatables.min.js') }}"></script>

<script type="text/javascript">
    //default values for DataTables
    $.extend($.fn.dataTable.defaults, {
        language: {
            url: '/osfrportal/lang/datatables-ru.json',
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
    $.fn.select2.defaults.set('amdLanguageBase', '/osfrportal/js/select2/i18n/');
</script>
<script type="text/javascript" src="{{ asset('osfrportal/js/btn-back-to-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/inputmask.binding.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/cryptode.js') }}"></script>
@stack('footer-scripts')
@stack('scripts')
@livewireScripts
