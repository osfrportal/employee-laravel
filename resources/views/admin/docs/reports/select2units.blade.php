<select class="form-select form-select-sm mb-3" id="js-all-sfrunits-ajax" name="sfrunits[]"
    data-placeholder="Выберите подразделение" data-minimum-input-length="0" data-selection-css-class="select2--small"
    data-dropdown-css-class="select2--small" multiple="multiple"></select>

@push('footer-scripts')
    <script type="module">
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('osfrapi.osfrportal.admin.select2.units.all') }}",
                dataType: 'json',
                success: function(json) {
                    $('#js-all-sfrunits-ajax').select2({
                        data: json.results,
                    });
                }
            });
        });
    </script>
@endpush
