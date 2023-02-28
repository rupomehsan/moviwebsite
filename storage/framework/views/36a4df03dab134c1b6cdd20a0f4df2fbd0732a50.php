<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Edit Admin</span>
                <div class="title-line"></div>

                <!-- Button trigger modal -->
            </div>
            
        </div>
    </div>
    

    
    <form id="adminCreateForm" method="POST" enctype="multipart/form-data"
        action="<?php echo e(URL::to('admin/admin/' . $target->id . '/update')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row create-body margin-top-40">

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <select name="user_role_id" id="userRole" class="form-control create-form">
                        <option value=" 0">Select Role</option>
                        <?php $__currentLoopData = $userRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $selected = '';
                            if ($id == $target->user_role_id) {
                                $selected = 'selected';
                            }
                            ?>
                            <option value="<?php echo e($id); ?>" <?php echo e($selected); ?>>
                                <?php echo e($name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <span class="text-danger"><?php echo e($errors->first('user_role_id')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" name="name" class="form-control create-form" id="name" placeholder="Name"
                        value="<?php echo e($target->name); ?>">
                    <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" name="email" class="form-control create-form" id="email" placeholder="Email"
                        value="<?php echo e($target->email); ?>" readonly>
                    <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" name="phone" class="form-control create-form" id="phone" placeholder="Phone"
                        value="<?php echo e($target->phone); ?>">
                    <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10" id="accessControl">
                <?php if($target->user_role_id != '1'): ?>
                    <h4>Access Control</h4>
                    <div class="row margin-top-20">



                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="manage" id="manage"
                                <?php echo in_array('manage', $access) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="manage">
                                Manage
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="video" id="video"
                                <?php echo in_array('video', $access) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="video">
                                Video
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="administration"
                                id="administration" <?php echo in_array('administration', $access) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="administration">
                                Administration
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="user" id="user"
                                <?php echo in_array('user', $access) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="user">
                                User
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="settings" id="settings"
                                <?php echo in_array('settings', $access) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="settings">
                                Settings
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="subscription" id="subscription"
                                <?php echo in_array('subscription', $access) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="subscription">
                                Subscription
                            </label>
                        </div>

                    </div>
                <?php endif; ?>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-20">
                <div class="col-md-6">
                    <?php if(!empty($target->image)): ?>
                    <div class="file-upload-edit">
                        <div class="image-upload-wrap-edit">
                            <input value="" name="image" class="file-upload-input-edit" type='file'
                                onchange="readURLEdit(this);" accept="image/*" />
                            <div class="drag-text-edit text-center">
                                <span class="iconify" data-icon="bx:bx-image-alt"></span>
                                <span>Upload Image Or Drag Here</span>
                            </div>
                        </div>
                        <div class="file-upload-content-edit">
                            <div class="image-title-wrap-edit">
                                <img class="file-upload-image-edit"
                                    src="<?php echo e(URL::to('/')); ?>/uploads/user/<?php echo e($target->image); ?>" alt="your image" />
                                <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                                    <span class="iconify" data-icon="akar-icons:cross"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php else: ?> 
                    <div class="file-upload">
                        <div class="image-upload-wrap">
                            <input name="image" id="image" class="file-upload-input" type='file' onchange="readURL(this);"
                                accept="image/*" />
                            <div class="drag-text text-center">
                                <span class="iconify" data-icon="teenyicons:user-square-outline"></span>
                                <span>Upload Image Or Drag Here</span>
                            </div>
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
                    <?php endif; ?>
                    <span class="text-danger"><?php echo e($errors->first('image')); ?></span>
                </div>
            </div>


            <div class="offset-md-1 col-md-10 actions margin-top-20">
                <button class="submit margin-bottom-20" type="submit" id="editUser">Update</button>
                <a href="/admin/admin" class="cancel">Cancel</a>
            </div>
            <div class=" margin-top-40">
            </div>
        </div>
    </form>
    



<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>

    <script type="text/javascript">
        // access control
        $(document).on("change", "#userRole", function(e) {
            e.preventDefault();
            var value = $(this).val();
            $("#accessControl").html('');
            if (value === '1') {
                // alert('asd');
                $("#accessControl").html('');
            } else {
                $("#accessControl").html(`
                    <h4>Access Control</h4>
                    <div class="row margin-top-20">

                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="manage" id="manage" checked>
                            <label class="form-check-label" for="manage">
                                Manage
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="video" id="video" checked>
                            <label class="form-check-label" for="video">
                                Video
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="administration"
                                id="administration" checked>
                            <label class="form-check-label" for="administration">
                                Administration
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="user" id="user" checked>
                            <label class="form-check-label" for="user">
                                User
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="settings" id="settings"
                                checked>
                            <label class="form-check-label" for="settings">
                                Settings
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="subscription" id="subscription"
                                checked>
                            <label class="form-check-label" for="subscription">
                                Subscription
                            </label>
                        </div>

                    </div>
                `);
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/admin/edit.blade.php ENDPATH**/ ?>