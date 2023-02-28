

<div class="form-select">
    <select id="episod" class="form-control create-form" name="episod_id">
        <option value="0" selected>Select Episode</option>
        @if (!empty($episodList))
        @foreach ($episodList as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
    @endif
    </select>
</div>