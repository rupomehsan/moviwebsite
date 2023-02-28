<div class="modal-content">
    <div class="modal-title">
        <h4>Add Country</h4>
        <div class="title-line"></div>
    </div>
    <form id="countryCreateForm" method="POST" enctype="multipart/form-data">
        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Country Name">
        </div>


        <div class="form-group margin-top-20">
            <select name="file_type" id="upload_type" class="form-control create-form">
                <option value="file">File</option> 
                <option value="link">Link</option> 
            </select>
        </div>

        <div class="form-group margin-top-20 display-none" id="fileLinkSection">
            <input name="file_link" type="text" class="form-control create-form" id="file_link" placeholder="Enter File Link">
        </div>

        <div class="file-upload">
            <div class="image-upload-wrap">
                <input name="image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                <div class="drag-text text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span>
                    <span>Upload Flag Or Drag Here</span>
                </div>
            </div>
            <div class="image-size-recomandation"><ul><li>Recomanded Image Size 200px*100px</li></ul></div>
            <div class="file-upload-content">
                <div class="image-title-wrap">
                    <img class="file-upload-image" src="#" alt="your image" />
                    <button type="button" onclick="removeUpload()" class="remove-image"><span class="iconify" data-icon="akar-icons:cross"></span></button>
                </div>
            </div>
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="createCountry">Save</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
