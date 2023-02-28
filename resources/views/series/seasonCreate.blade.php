<div class="modal-content">
    <div class="modal-title">
        <h4>Add Season</h4>
        <div class="title-line"></div>
    </div>
    <form id="seasonCreateForm" method="POST" enctype="multipart/form-data">


        <div class="form-group margin-top-20">
            <select name="series_id" id="seriesType" class="form-control create-form">
                <option value="0" selected>Select Series</option>
                @foreach($seriesList as $id=>$name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach  
            </select>
        </div>

        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Season Name">
        </div>


        {{-- <div class="file-upload">
            <div class="image-upload-wrap">
                <input name="image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                <div class="drag-text text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
            <div class="image-size-recomandation"><ul><li>Recomanded Image Size 200px*320px</li></ul></div>
            <div class="file-upload-content">
                <div class="image-title-wrap">
                    <img class="file-upload-image" src="#" alt="your image" />
                    <button type="button" onclick="removeUpload()" class="remove-image">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div> --}}

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="createSeason">Save</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
