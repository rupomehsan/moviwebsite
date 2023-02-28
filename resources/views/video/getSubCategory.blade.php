<select id="subCategoryType" class="form-control create-form" name="sub_category_id">
    <option value="0" selected>Select Sub Category</option>
    @if (!empty($subCategoryList))
        @foreach ($subCategoryList as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
    @endif
</select>
