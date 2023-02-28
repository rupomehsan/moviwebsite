

<div class="form-select">
    <select id="seriesId" class="form-control create-form" name="series_id">
        <option value="0" selected>Select Series</option>
        @if (!empty($seriesList))
        @foreach ($seriesList as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
    @endif
    </select>
</div>