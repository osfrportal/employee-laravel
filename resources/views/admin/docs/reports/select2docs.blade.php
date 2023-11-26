<select class="form-select form-select-sm mb-3" id="js-all-sfrdocs-ajax" name="sfrdocs[]"
    data-placeholder="Выберите документы" data-minimum-input-length="0" data-selection-css-class="select2--small"
    data-dropdown-css-class="select2--small" multiple="multiple"></select>

@push('footer-scripts')
    <script type="module">
        $(document).ready(function() {
            var test = $.getJSON("{{ route('osfrapi.osfrportal.admin.select2.docs.allgrouped') }}", function(data) {
                console.log(data.text);
                console.log(data.error);
            });
            console.log(test);
            $('#js-all-sfrdocs-ajax').select2({
                ajax: {
                    dataType: 'json',
                    delay: 500,
                    url: "{{ route('osfrapi.osfrportal.admin.select2.docs.allgrouped') }}",
                }
            });
            $('#js-all-sfrdocs-ajax').on('select2:opening select2:closing', function(event) {
                var $searchfield = $(this).parent().find('.select2-search__field');
                $searchfield.prop('disabled', true);
            });
        });
    </script>
@endpush
