<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Tv Channel</h4>
        <div class="title-line"></div>
    </div>
    <form id="tvEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $target->id }}">

        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name"
                placeholder="Tv Channel Name" value="{{ $target->name }}">
        </div>

        <div class="form-group margin-top-20">
            <input name="url" type="text" class="form-control create-form" id="url"
                placeholder="Stream URL" value="{{ $target->url }}">
        </div>

        <div class="form-group margin-top-20">
            <select name="tv_channel_category_id" id="tvType" class="form-control create-form">
                <option value="0">Select Category</option>

                @if (!empty($categoryList))
                    @foreach ($categoryList as $id => $name)
                        <?php
                        $selected = '';
                        if ($id == $target->tv_channel_category_id) {
                            $selected = 'selected';
                        }
                        ?>
                        <option value="{{ $id }}" {{ $selected }}>{{ $name }}</option>
                    @endforeach
                @endif

            </select>
        </div>

        <div class="form-group margin-top-20">
            <select name="stream_type" id="streamType" class="form-control create-form">
                <option value="0">Select Stream Type</option>

                @if (!empty($streamTypeArr))
                    @foreach ($streamTypeArr as $id => $name)
                        <?php
                        $selected = '';
                        if ($id == $target->stream_type) {
                            $selected = 'selected';
                        }
                        ?>
                        <option value="{{ $id }}" {{ $selected }}>{{ $name }}</option>
                    @endforeach
                @endif

            </select>
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
                    <li>Recomanded Image Size 200px*80px</li>
                </ul>
            </div>
            <div class="file-upload-content-edit">
                <div class="image-title-wrap-edit">
                    <img class="file-upload-image-edit" src="{{ URL::to('/') }}/uploads/tv/{{ $target->image }}"
                        alt="your image" />
                    <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div>

        {{-- <div class="form-group margin-top-20">
            <input type="text" name="file_url" class="form-control create-form" id="file_url" placeholder="Image/File URL"" value="{{ $target->file_url }}">
        </div> --}}
        <div class="col-md-12">
            <div class="form-check form-switch margin-top-20 text-center">
                <label class="form-check-label" for="parentalYesNo">Is this video is Parental Content? </label>
                <input class="form-check-input" name="is_parental" type="checkbox" id="parentalYesNo"
                    {{ $target->is_parental == 'on' ? 'checked' : '' }}>
                <span class="text-danger">{{ $errors->first('is_parental') }}</span>
            </div>
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="editTv">Update</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
