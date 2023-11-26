<select class="form-select form-select-sm mb-3" id="js-all-sfrdocs-ajax" name="sfrdocs[]"
    data-placeholder="Выберите документы" data-minimum-input-length="0"
    data-selection-css-class="select2--small" data-dropdown-css-class="select2--small" multiple="multiple"></select>

@push('footer-scripts')
    <script type="module">
        $(document).ready(function() {
            $('#js-all-sfrdocs-ajax').select2({
                ajax: {
                    dataType: 'json',
                    delay: 500,
                    url: "{{ route('osfrapi.osfrportal.admin.select2.docs.allgrouped') }}",
                }
            });
        });
    </script>
@endpush
