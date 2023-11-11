<select class="form-select form-select-sm" id="unitparentid" name="unitparentid">>
    <option value="0">&nbsp;</option>
    @if ($all_units->count())
        @foreach ($all_units as $unit)
            <option value="{{ $unit['unitid'] }}"
                @if (isset($child)) @selected($unit['unitid'] == $child->unitparentid) @endif>
                {{ $unit['unitcode'] ?? '' }} - {{ $unit['unitname'] }}</option>
        @endforeach
    @endif
</select>
