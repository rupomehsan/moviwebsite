<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Sponsor Banner</h4>
        <div class="title-line"></div>
    </div>
    <form id="sponsorBannerEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo e($target->id); ?>">

        <div class="form-group margin-top-20">
            <input name="title" type="text" class="form-control create-form" id="title" placeholder=" Banner Title" value="<?php echo e($target->title); ?>">
        </div>

        <div class="form-group margin-top-20">
            <input type="text" name="url" class="form-control create-form" id="url" placeholder="Banner URL" value="<?php echo e($target->url); ?>">
        </div>


        <div class="form-group margin-top-20">
            <select name="file_type" id="upload_type" class="form-control create-form">
                <option value="file" <?php echo $target->file_type == 'file' || $target->file_type == null ? 'selected' : ''; ?>>File</option>
                <option value="link"<?php echo $target->file_type == 'link' ? 'selected' : ''; ?>>Link</option>
            </select>
        </div>

        <div class="form-group margin-top-20 <?php echo $target->file_type == 'link' ? '' : 'display-none'; ?>" id="fileLinkSection">
            <input name="file_link" type="text" class="form-control create-form" id="file_link"
                placeholder="Enter File Link" value="<?php echo e($target->file_link); ?>">
        </div>

        <div class="file-upload-edit <?php echo $target->file_type == 'link' ? 'display-none-urgent' : ''; ?>">
            <div class="image-upload-wrap-edit">
                <input value="" name="image" class="file-upload-input-edit" type='file' onchange="readURLEdit(this);" accept="image/*" />
                <div class="drag-text-edit text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
            <div class="image-size-recomandation-edit display-none"><ul><li>Recomanded Image Size 200px*320px</li></ul></div>
            <div class="file-upload-content-edit">
                <div class="image-title-wrap-edit">
                    <img class="file-upload-image-edit" src="<?php echo e(URL::to('/')); ?>/uploads/sponsor/<?php echo e($target->image); ?>" alt="<?php echo e($target->title); ?>" />
                    <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="editSponsorBanner">Update</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/sponsor/sponsorBannerEdit.blade.php ENDPATH**/ ?>