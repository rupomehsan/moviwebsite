<div class="modal-content">
    <div class="modal-title">
        <h4>Add Package</h4>
        <div class="title-line"></div>
    </div>
    <form id="packageCreateForm" method="POST" enctype="multipart/form-data">
        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Enter Package Name">
        </div>

        <div class="form-group margin-top-20">
            <select name="validity" id="validity" class="form-control create-form">
                <option value="" selected>Enter Validity</option> 
                <option value="1">1 Day</option> 
                <option value="7">1 Week (7 Day)</option> 
                <option value="14">2 Week (14 Day)</option> 
                <option value="30">1 Month (30 Day)</option> 
                <option value="90">3 Month (90 Day)</option> 
                <option value="180">6 Month (180 Day)</option> 
                <option value="365">1 Year (365 Day)</option> 
            </select>
        </div>

        <div class="form-group margin-top-20">
            <input name="price" type="number" class="form-control create-form" id="price" placeholder="Enter Price">
        </div>

        <div class="form-group margin-top-20">
            <textarea class="form-control create-form" id="description" name="description" rows="10"
                placeholder="Video Description *"></textarea>
        </div>

        <div class="form-group margin-top-20">
            <select name="status" id="status" class="form-control create-form">
                <option value="active" selected>Active</option> 
                <option value="inactive">Inactive</option> 
            </select>
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="createPackage">Save</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/package/create.blade.php ENDPATH**/ ?>