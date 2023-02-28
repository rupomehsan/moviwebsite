<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Artist</h4>
        <div class="title-line"></div>
    </div>
    <form id="celebrityEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $target->id }}">

        <div class="form-group margin-top-20">
            <select name="celebrity_type_id" id="celebrityTypeType" class="form-control create-form">
                <option value="0">Select Artist Type</option>
                @foreach ($celebrityTypeList as $id => $name)
                    <?php
                    $selected = '';
                    if ($id == $target->celebrity_type_id) {
                        $selected = 'selected';
                    }
                    ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name"
                placeholder="Artist name" value="{{ $target->name }}">
        </div>


        <div class="form-group margin-top-20">
            <select name="file_type" id="upload_type" class="form-control create-form">
                <option value="file" {!! $target->file_type == 'file' || $target->file_type == null ? 'selected' : '' !!}>File</option>
                <option value="link"{!! $target->file_type == 'link' ? 'selected' : '' !!}>Link</option>
            </select>
        </div>

        <div class="form-group margin-top-20 {!! $target->file_type == 'link' ? '' : 'display-none' !!}" id="fileLinkSection">
            <input name="file_link" type="text" class="form-control create-form" id="file_link"
                placeholder="Enter File Link" value="{{ $target->file_link }}">
        </div>

        <div class="file-upload-edit {!! $target->file_type == 'link' ? 'display-none-urgent' : '' !!}">
            <div class="image-upload-wrap-edit">
                <input value="" name="image" class="file-upload-input-edit" type='file'
                    onchange="readURLEdit(this);" accept="image/*" />
                <div class="drag-text-edit text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
            <div class="image-size-recomandation-edit display-none">
                <ul>
                    <li>Recomanded Image Size 200px*200px</li>
                </ul>
            </div>
            <div class="file-upload-content-edit">
                <div class="image-title-wrap-edit">
                    <img class="file-upload-image-edit" src="{{ URL::to('/') }}/uploads/celebrity/{{ $target->image }}"
                        alt="{{ $target->title }}" />
                    <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="editCelebrity">Update</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
