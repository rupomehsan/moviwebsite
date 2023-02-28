<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Basic Settings</span>
                <div class="title-line"></div>

                <!-- Button trigger modal -->
            </div>
            

            
            <div class="col-md-4 text-right">
                <button type="button" class="create-button" data-toggle="modal" data-target="#passModal" id="passBtn">
                    Change Password
                </button>
            </div>
            
        </div>
    </div>
    
    <?php
$ses_msg = Session::has('success');
if (!empty($ses_msg)) {
    ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('success'); ?></p>
    </div>
    <?php
}//
$ses_msg = Session::has('error');
if (!empty($ses_msg)) {
    ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('error'); ?></p>
    </div>
    <?php
}// ?>

    
    <form id="settingsForm" method="POST" enctype="multipart/form-data"
        action="<?php echo e(URL::to('admin/basic-settings/update')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row create-body margin-top-20">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="systemName">System Name *</label>
                    <input type="text" name="system_name" class="form-control create-form" id="systemName"
                        placeholder="System Name"
                        value="<?php echo e($target ? $target->system_name ?? old('system_name') : old('system_name')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('system_name')); ?></span>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="appVersion">Web/App Version </label>
                    <input type="text" name="app_version" class="form-control create-form" id="appVersion"
                        placeholder="App Version"
                        value="<?php echo e($target ? $target->app_version ?? old('app_version') : old('app_version')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('app_version')); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <span>Logo *</span>
                    <p>
                        <input type="file" accept="image/*" name="logo" id="fileCH" onchange="loadFileCH(event)"
                            style="display: none;">
                    </p>
                    <p class="btn btn-outline-dark btn-sm web-ad-img-btn setting-file-btn">
                        <label for="fileCH" style="cursor: pointer;">
                            <span class="iconify" data-icon="ant-design:upload-outlined"></span> &nbsp;
                            Upload Logo
                        </label>
                    </p>
                    <p>
                        <?php if(!empty($target)): ?>
                            <?php if(!empty($target->logo)): ?>
                                <img src="<?php echo e(URL::to('/')); ?>/uploads/<?php echo e($target->logo); ?>" alt="Custom" title="Custom"
                                    id="CHImg" width="200" />
                            <?php else: ?>
                                <img id="CHImg" width="200" />
                            <?php endif; ?>
                        <?php else: ?>
                            <img id="CHImg" width="200" />
                        <?php endif; ?>
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <span>Logo Icon *</span>
                    <p>
                        <input type="file" accept="image/*" name="logo_icon" id="fileCH2" onchange="loadFileCH2(event)"
                            style="display: none;">
                    </p>
                    <p class="btn btn-outline-dark btn-sm web-ad-img-btn setting-file-btn">
                        <label for="fileCH2" style="cursor: pointer;">
                            <span class="iconify" data-icon="ant-design:upload-outlined"></span> &nbsp;
                            Upload Logo Icon
                        </label>
                    </p>
                    <p>
                        <?php if(!empty($target)): ?>
                            <?php if(!empty($target->logo_icon)): ?>
                                <img src="<?php echo e(URL::to('/')); ?>/uploads/<?php echo e($target->logo_icon); ?>" alt="Custom"
                                    title="Custom" id="CHImg2" width="200" />
                            <?php else: ?>
                                <img id="CHImg2" width="200" />
                            <?php endif; ?>
                        <?php else: ?>
                            <img id="CHImg2" width="200" />
                        <?php endif; ?>
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="copyright">Copyright *</label>
                    <input type="text" name="copyright" class="form-control create-form" id="copyright"
                        placeholder="your company copyright"
                        value="<?php echo e($target ? $target->copyright ?? old('copyright') : old('copyright')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('copyright')); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mailAddress">Mail Address *</label>
                    <input type="text" name="mail_address" class="form-control create-form" id="mailAddress"
                        placeholder="Mail Address"
                        value="<?php echo e($target ? $target->mail_address ?? old('mail_address') : old('mail_address')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('mail_address')); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="developedBy">Developed By</label>
                    <input type="text" name="developed_by" class="form-control create-form" id="developedBy"
                        placeholder="Developed By"
                        value="<?php echo e($target ? $target->developed_by ?? old('developed_by') : old('developed_by')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('developed_by')); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="website">Company Website</label>
                    <input type="text" name="website" class="form-control create-form" id="website"
                        placeholder="www.ccninfotech.com"
                        value="<?php echo e($target ? $target->website ?? old('website') : old('website')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('website')); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="updateApp">Update App Link</label>
                    <input type="text" name="update_app" class="form-control create-form" id="updateApp"
                        placeholder="Update App Link"
                        value="<?php echo e($target ? $target->update_app ?? old('update_app') : old('update_app')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('update_app')); ?></span>
                </div>
            </div>


            <div class="col-md-12 margin-top-40">
                <div class="row">
                    
                    <div class="col-md-8 content-title">
                        <span class="title">Social Accounts</span>

                        

                        <div class="title-line"></div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-6 margin-top-20">
                <div class="form-group">
                    <label for="facebook">Facebook Page</label>
                    <input type="text" name="facebook" class="form-control create-form" id="facebook"
                        placeholder="facebook link"
                        value="<?php echo e($target ? $target->facebook ?? old('facebook') : old('facebook')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('facebook')); ?></span>
                </div>
            </div>
            <div class="col-md-6 margin-top-20">
                <div class="form-group">
                    <label for="instagram">Instagram Page</label>
                    <input type="text" name="instagram" class="form-control create-form" id="instagram"
                        placeholder="instagram link"
                        value="<?php echo e($target ? $target->instagram ?? old('instagram') : old('instagram')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('instagram')); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" name="twitter" class="form-control create-form" id="twitter"
                        placeholder="twitter link"
                        value="<?php echo e($target ? $target->twitter ?? old('twitter') : old('twitter')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('twitter')); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="youtube">Youtube Channel</label>
                    <input type="text" name="youtube" class="form-control create-form" id="youtube"
                        placeholder="youtube link"
                        value="<?php echo e($target ? $target->youtube ?? old('youtube') : old('youtube')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('youtube')); ?></span>
                </div>
            </div>
            <div class="socialContent">
            </div>



            
            <div class="col-md-12 margin-top-40">
                <div class="row">
                    
                    <div class="col-md-8 content-title">
                        <span class="title">Parental Control</span>
                        <div class="title-line"></div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-6 margin-top-20">
                <div class="form-check form-switch margin-top-20 text-center">
                    <label class="form-check-label" for="is_parental_control">Is Parental Control? </label>
                    <input class="form-check-input" name="is_parental_control" type="checkbox" id="is_parental_control"
                    <?php echo e($target->is_parental_control == 'on' ? 'checked' : ''); ?>>
                    <span class="text-danger"><?php echo e($errors->first('is_parental_control')); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="parentalPassword">Parental Password</label>
                    <input type="text" name="parental_password" class="form-control create-form" id="parentalPassword"
                        placeholder="Enter Parental Password"
                        value="<?php echo e($target ? $target->parental_password ?? old('parental_password') : old('parental_password')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('parental_password')); ?></span>
                </div>
            </div>

            <div class="col-md-12 margin-top-40">
                <div class="row">
                    
                    <div class="col-md-8 content-title">
                        <span class="title">Legal Information</span>
                        <div class="title-line"></div>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group margin-top-20">
                    <label for="aboutUs">About Us *<span class="gray">(About Company)</span></label>
                    <textarea class="form-control create-form" id="aboutUs" name="about_us" rows="20"
                        placeholder="Describe about company information"><?php echo e($target ? $target->about_us ?? old('about_us') : old('about_us')); ?></textarea>
                    <span class="text-danger"><?php echo e($errors->first('about_us')); ?></span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="privacy">Privacy & Policy *</label>
                    <textarea class="form-control create-form" id="privacy" name="privacy_policy" rows="10"
                        placeholder="Write Here Privacy & Policy"><?php echo e($target ? $target->privacy_policy ?? old('privacy_policy') : old('privacy_policy')); ?></textarea>
                    <span class="text-danger"><?php echo e($errors->first('privacy_policy')); ?></span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="cookies">Cookies Policy *</label>
                    <textarea class="form-control create-form" id="cookies" name="cookies_policy" rows="10"
                        placeholder="Write Here Cookies Policy"><?php echo e($target ? $target->cookies_policy ?? old('cookies_policy') : old('cookies_policy')); ?></textarea>
                    <span class="text-danger"><?php echo e($errors->first('cookies_policy')); ?></span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="terms">Terms & Conditions *</label>
                    <textarea class="form-control create-form" id="terms" name="terms_policy" rows="10"
                        placeholder="Write Here Terms & Conditions"><?php echo e($target ? $target->terms_policy ?? old('terms_policy') : old('terms_policy')); ?></textarea>
                    <span class="text-danger"><?php echo e($errors->first('terms_policy')); ?></span>
                </div>
            </div>

            <div class="col-md-12 margin-top-40">
                <div class="row">
                    
                    <div class="col-md-8 content-title">
                        <span class="title">SEO Configuration</span>
                        <div class="title-line"></div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-12 margin-top-20">
                <div class="form-group">
                    <label for="seo_title">SEO Title</label>
                    <input name="seo_title" type="text" class="form-control create-form" id="seo_title"
                        placeholder="Write SEO Title Here"
                        value="<?php echo e($target ? $target->seo_title ?? old('seo_title') : old('seo_title')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('seo_title')); ?></span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea class="form-control create-form" id="meta_description" name="meta_description" rows="10"
                        placeholder="Write Meta Description Here"><?php echo e($target ? $target->meta_description ?? old('meta_description') : old('meta_description')); ?></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="focus_keyword">Focus Keyword</label>
                    <textarea class="form-control create-form" id="focus_keyword" name="focus_keyword" rows="10"
                        placeholder="Write Focus Keyword Here (use comma(,) to separate keyword)"><?php echo e($target ? $target->focus_keyword ?? old('focus_keyword') : old('focus_keyword')); ?></textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="seo_tag">SEO Tag</label>
                    <textarea class="form-control create-form" id="seo_tag" name="seo_tag" rows="10"
                        placeholder="Write SEO Tag Here (use comma(,) to separate tags)"><?php echo e($target ? $target->seo_tag ?? old('seo_tag') : old('seo_tag')); ?></textarea>
                </div>
            </div>

            <div class="col-md-12 actions margin-top-10">
                <button type="submit" class="submit margin-bottom-20">Update</button>
                <a href="/admin/basic-settings" class="cancel">Cancel</a>
            </div>
            <div class=" margin-top-40">
            </div>
        </div>
    </form>
    

    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="passModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal">

            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        // create Modal
        $(document).on("click", "#crateBtn", function(e) {
            e.preventDefault();
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/basic-settings/add-social-account',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#showCreateModal").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });

        // set social data
        $(document).on("click", "#addSocial", function(e) {
            e.preventDefault();
            var formData = new FormData($('#addSocialForm')[0]);
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/basic-settings/add-social',
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    console.log(res);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    if (jqXhr.status == 422) {
                        var errorsHtml = '';
                        var errors = jqXhr.responseJSON.message;
                        $.each(errors, function(key, value) {
                            errorsHtml += `<li>${value}</li>`
                        });
                        toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
                    } else if (jqXhr.status == 404) {
                        toastr.error(jqXhr.responseJSON.message, '', options);
                    } else {
                        toastr.error('Error', 'Something went wrong', options);
                    }
                    App.unblockUI();
                    $('.loading-spinner').css("display", "none");
                }
            });
            // var socialName = $("#socialName").val();
            // var socialLink = $("#socialLink").val();
            // var socialIcon = $("#socialIcon").val();
            // alert(socialIcon);
        });

        // pass change Modal
        $(document).on("click", "#passBtn", function(e) {
            e.preventDefault();
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/basic-settings/change-password',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#showCreateModal").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });

        // update Password
        $(document).on("click", "#changePass", function(e) {
            e.preventDefault();
            var formData = new FormData($('#changePassForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/basic-settings/update-password',
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    toastr.success('Password Changed successfully', res, options);
                    setTimeout(location.reload.bind(location), 1000);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    if (jqXhr.status == 422) {
                        var errorsHtml = '';
                        var errors = jqXhr.responseJSON.message;
                        $.each(errors, function(key, value) {
                            errorsHtml += `<li>${value}</li>`
                        });
                        toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
                    } else if (jqXhr.status == 404) {
                        toastr.error(jqXhr.responseJSON.message, '', options);
                    } else {
                        toastr.error('Error', 'Something went wrong', options);
                    }
                    $('.loading-spinner').css("display", "none");
                    App.unblockUI();
                }
            });
        });

        // logo
        var loadFileCH = function(event) {
            var image = document.getElementById('CHImg');
            // alert(image);
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        // logo icon
        var loadFileCH2 = function(event) {
            var image2 = document.getElementById('CHImg2');
            image2.src = URL.createObjectURL(event.target.files[0]);
        };
        //privecy text editor
        ClassicEditor
            .create(document.querySelector('#privacy'))
            .catch(error => {
                console.error(error);
            });

        //cookies text editor
        ClassicEditor
            .create(document.querySelector('#cookies'))
            .catch(error => {
                console.error(error);
            });

        //terms text editor
        ClassicEditor
            .create(document.querySelector('#terms'))
            .catch(error => {
                console.error(error);
            });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/projectx/Desktop/laravelProjects/movieflix-main/resources/views/settings/basicSettings.blade.php ENDPATH**/ ?>