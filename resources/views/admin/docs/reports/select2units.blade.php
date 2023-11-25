<select class="form-select form-select-sm mb-3" id="js-all-sfrunits-ajax" name="sfrunits[]"
    data-placeholder="Выберите подразделение" data-allow-clear="true"
    data-selection-css-class="select2--small" data-dropdown-css-class="select2--small" multiple="multiple"></select>

@push('footer-scripts')
    <script type="module">
        $(document).ready(function() {
            $('#js-all-sfrunits-ajax').select2({
                ajax: {
                    dataType: 'json',
                    url: function(params) {
                        return "{{ route('osfrapi.osfrportal.admin.select2.units.all') }}";
                    }
                }
            });
        });
    </script>
@endpush
