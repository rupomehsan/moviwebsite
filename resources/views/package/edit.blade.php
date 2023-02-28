<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Package</h4>
        <div class="title-line"></div>
    </div>
    <form id="packageEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $target->id }}">

        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Package Name" value="{{ $target->name }}">
        </div>

        <div class="form-group margin-top-20">
            <select name="validity" id="validity" class="form-control create-form">
                <option value="">Select Validity</option>
                <option value="1" {{ $target->validity == '1' ? 'selected' : '' }}>1 Day</option> 
                <option value="7" {{ $target->validity == '7' ? 'selected' : '' }}>1 Week (7 Day)</option> 
                <option value="14" {{ $target->validity == '14' ? 'selected' : '' }}>2 Week (14 Day)</option> 
                <option value="30" {{ $target->validity == '30' ? 'selected' : '' }}>1 Month (30 Day)</option> 
                <option value="90" {{ $target->validity == '90' ? 'selected' : '' }}>3 Month (90 Day)</option> 
                <option value="180" {{ $target->validity == '180' ? 'selected' : '' }}>6 Month (180 Day)</option> 
                <option value="365" {{ $target->validity == '365' ? 'selected' : '' }}>1 Year (365 Day)</option> 
            </select>
        </div>

        <div class="form-group margin-top-20">
            <input name="price" type="number" class="form-control create-form" id="price" placeholder="Enter Price" value="{{ $target->price }}">
        </div>

        <div class="form-group margin-top-20">
            <textarea class="form-control create-form" id="description" name="description" rows="10"
                placeholder="Video Description">{{ $target->description ?? '' }}</textarea>
        </div>

        <div class="form-group margin-top-20">
            <select name="status" id="status" class="form-control create-form">
                <option value="active" {{ $target->status == 'active' ? 'selected' : '' }}>Active</option> 
                <option value="inactive" {{ $target->status == 'inactive' ? 'selected' : '' }}>Inactive</option> 
            </select>
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="editPackage">Update</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
