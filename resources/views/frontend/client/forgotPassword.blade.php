@extends('frontend.layouts.client.index')
@section('content')
    <div class="frontend-login-pannel row margin-top-150">
        <div class="frontend-login-title col-md-12 text-center">Change Your Password</div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form id="verification" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="email" id="sendEmail" value="{{ request('email') }}">

                <div class="input-group mb-3">
                    <div class="input-group-prepend vrification-pass">
                        <span class="input-group-text" id="password-addon">New Password</span>
                    </div>
                    <input id="password" type="password" class="form-control" name="password"
                        placeholder="Please enter your password" aria-describedby="password-addon">
                </div>
                <div class="input-group mb-3 margin-top-40">
                    <div class="input-group-prepend vrification-pass">
                        <span class="input-group-text" id="password_confirmation-addon">Confirmed Password</span>
                    </div>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                        placeholder="Please enter your confimed password" aria-describedby="password_confirmation-addon">
                </div>

                <div class="form-group text-center margin-top-40">
                    <button type="submit" class="btn btn-danger login-submit pass-submit">
                        Change
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('custom-js')
    <script type="text/javascript">
        // save
        $(document).on("click", ".pass-submit", function(e) {
            e.preventDefault();
            // var formData = new FormData($('#verification')[0]);

            var email = $('#sendEmail').val();
            var password = $('#password').val();
            var password_confirmation = $('#password_confirmation').val();
            // alert(email);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-top-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/api/v1/auth/change-password',
                type: 'patch',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    toastr.success('Password changed successfully.! Please login your account.',
                        options);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    if (jqXhr.status == 422) {
                        var errorsHtml = '';
                        var errors = jqXhr.responseJSON.data;
                        $.each(errors, function(key, value) {
                            errorsHtml += `<li>${value}</li>`
                        });
                        toastr.error(errorsHtml, 'Validation Error', options);
                    } else if (jqXhr.status == 401) {
                        toastr.error(jqXhr.responseJSON.message, '', options);
                    } else if (jqXhr.status == 404) {
                        toastr.error(jqXhr.responseJSON.message, '', options);
                    } else {
                        toastr.error('Error', 'Something went wrong', options);
                    }
                    $('.loading-spinner').css("display", "none");
                }
            });
        });
    </script>
@endpush
