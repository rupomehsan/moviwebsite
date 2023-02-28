<div class="modal-content">
    <div class="modal-title">
        <h4>Artist Type Edit</h4>
        <div class="title-line"></div>
    </div>
    <form id="celebrityTypeUpdateForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $target->id }}">
        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Artist Type Name" value="{{ $target->name }}">
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="updateCelebrityType">Update</button>
            <button type="button" class=" margin-top-10 cancel cancel-type-create">Cancel</button>
        </div>
    </form>

</div>
