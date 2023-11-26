<select class="form-select form-select-sm mb-3" id="js-all-sfrdocs-ajax" name="sfrdocs[]"
    data-placeholder="Выберите документы" data-minimum-input-length="0" data-selection-css-class="select2--small"
    data-dropdown-css-class="select2--small" multiple="multiple"></select>

@push('footer-scripts')
    <script type="module">
        $(document).ready(function() {
            var context;
            $.ajax({
                url: "{{ route('osfrapi.osfrportal.admin.select2.docs.allgrouped') }}",
                async: false,
                dataType: 'json',
                success: function(json) {
                    assignVariable(json);
                }
            });

            function assignVariable(data) {
                context = data;
            }
            console.log(context);
            $('#js-all-sfrdocs-ajax').select2({
                data: context
            });
            $('#js-all-sfrdocs-ajax').on('select2:opening select2:closing', function(event) {
                var $searchfield = $(this).parent().find('.select2-search__field');
                $searchfield.prop('disabled', true);
            });
        });
    </script>
@endpush
