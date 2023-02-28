<div class="modal-content">
    <div class="modal-title">
        <h4>Change Password</h4>
        <div class="title-line"></div>
    </div>
    <form id="changePassForm" method="POST" enctype="multipart/form-data">

        <div class="form-group margin-top-20">
            <input name="old_password" type="text" class="form-control create-form" id="old" placeholder="Old Password">
        </div>

        <div class="form-group margin-top-20">
            <input name="password" type="text" class="form-control create-form" id="password" placeholder="New Password">
        </div>

        <div class="form-group margin-top-20">
            <input name="password_confirmation" type="text" class="form-control create-form" id="confirm" placeholder="Confirm Password">
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="changePass">Change</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/settings/changePassword.blade.php ENDPATH**/ ?>