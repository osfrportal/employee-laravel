<script type="text/javascript" src="{{ asset('osfrportal/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/jquery.inputmask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/select2/i18n/ru.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/sweetalert.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('osfrportal/js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/apexcharts/apexcharts.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/chartjs/chart.umd.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('osfrportal/js/quill/quill.min.js') }}"></script>

<script type="text/javascript">
    //default for chart.js
    //Chart.defaults.interaction.mode = 'nearest';

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

    $.fn.select2.defaults.set('theme', 'bootstrap-5');
    $.fn.select2.defaults.set('language', 'ru');
    $.fn.select2.defaults.set('minimumInputLength', 4);
    $.fn.select2.defaults.set('allowClear', true);

    $.getJSON('/osfrportal/lang/apexcharts-ru.json', function(data) {
        var ru = data;
        Apex.chart = {
            locales: [ru],
            defaultLocale: "ru",
        }
    });
</script>
<script type="text/javascript" src="{{ asset('osfrportal/js/btn-back-to-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/inputmask.binding.js') }}"></script>
<script type="text/javascript" src="{{ asset('osfrportal/js/cryptode.js') }}"></script>
@stack('footer-scripts')
@stack('scripts')
@livewireScripts
<script type="text/javascript">
    document.addEventListener('livewire:init', () => {
        Livewire.on('docsnotsigned-message', (message) => {
            console.log(message);
            Swal.fire({
                title: "Are you sure?",
                text: message,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ознакомиться"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });
        });
    });
</script>
