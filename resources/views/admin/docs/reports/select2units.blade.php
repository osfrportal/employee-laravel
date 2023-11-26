<select class="form-select form-select-sm mb-3" id="js-all-sfrunits-ajax" name="sfrunits[]"
    data-placeholder="Выберите подразделение" data-minimum-input-length="0" data-selection-css-class="select2--small"
    data-dropdown-css-class="select2--small" multiple="multiple"></select>

@push('footer-scripts')
    <script type="module">
        $(document).ready(function() {
            $('#js-all-sfrunits-ajax').select2({
                ajax: {
                    dataType: 'json',
                    delay: 500,
                    url: "{{ route('osfrapi.osfrportal.admin.select2.units.all') }}",
                }
            });
            $('#js-all-sfrunits-ajax').on('select2:opening select2:closing', function(event) {
                var $searchfield = $(this).parent().find('.select2-search__field');
                $searchfield.prop('disabled', true);
            });
        });
    </script>
@endpush
