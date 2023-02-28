<div class="modal-content">
    <div class="modal-title">
        <h4>Add More Social Account</h4>
        <div class="title-line"></div>
    </div>
    <form id="addSocialForm" method="POST" enctype="multipart/form-data">

        <div class="form-group margin-top-40">
            <input name="name" type="text" class="form-control create-form" id="socialName"
                placeholder="Social Account Name *">
        </div>

        <div class="form-group margin-top-40">
            <input name="link" type="text" class="form-control create-form" id="socialLink"
                placeholder="Social Account Link *">
        </div>

        <div class="file-upload">
            <div class="image-upload-wrap">
                <input name="image" class="file-upload-input" id="socialIcon" type='file' onchange="readURL(this);"
                    accept="image/*" />
                <div class="drag-text text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span>
                    <span>Upload Social Icon or Drag Here *</span>
                </div>
            </div>
            <div class="image-size-recomandation">
                <ul>
                    <li>Recomanded Image Size 200px*200px</li>
                </ul>
            </div>
            <div class="file-upload-content">
                <div class="image-title-wrap">
                    <img class="file-upload-image" src="#" alt="your image" />
                    <button type="button" onclick="removeUpload()" class="remove-image">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="actions margin-top-40">
            <button class="submit" type="submit" id="addSocial">Add Social Acount</button>
            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
