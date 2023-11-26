<select class="form-select form-select-sm mb-3" id="js-all-sfrunits-ajax" name="sfrunits[]"
    data-placeholder="Выберите подразделение" data-minimum-input-length="0" data-selection-css-class="select2--small"
    data-dropdown-css-class="select2--small" multiple="multiple"></select>

@push('footer-scripts')
    <script type="module">
        $(document).ready(function() {
            function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function(idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            $('#js-all-sfrunits-ajax').select2({
                matcher: matchStart,
                ajax: {
                    dataType: 'json',
                    delay: 500,
                    url: function(params) {
                        return "{{ route('osfrapi.osfrportal.admin.select2.units.all') }}";
                    }
                }
            });
        });
    </script>
@endpush
