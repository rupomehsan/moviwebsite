

<div class="form-select">
    <select id="season" class="form-control create-form" name="season_id">
        <option value="0" selected>Select Season</option>
        @if (!empty($seasonList))
        @foreach ($seasonList as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
    @endif
    </select>
</div>