@extends('frontend.layouts.client.index')
@section('content')
    <div class="frontend-login-pannel row margin-top-150">
        <div class="frontend-login-title col-md-12 text-center">Forgot You Password</div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form id="registration" method="POST" enctype="multipart/form-data">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="name-addon">Name</span>
                    </div>
                    <input id="name" type="text" class="form-control " name="name"
                         placeholder="Please enter your name" 
                        aria-describedby="name-addon">
                </div>

                <div class="input-group mb-3 margin-top-40">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="email-addon1">Email</span>
                    </div>
                    <input id="sendEmail" type="email" class="form-control " name="email"
                         placeholder="Please enter your email" 
                        aria-describedby="email-addon1">
                </div>

                <div class="input-group mb-3 margin-top-40">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="phone-addon">Phone</span>
                    </div>
                    <input id="phone" type="text" class="form-control " name="phone"
                         placeholder="Please enter your phone" 
                        aria-describedby="phone-addon">
                </div>

                <div class="input-group mb-3 margin-top-40">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="password-addon">Password</span>
                    </div>
                    <input id="password" type="text" class="form-control " name="password"
                         placeholder="Please enter your password" 
                        aria-describedby="password-addon">
                </div>

                <div class="form-group text-center margin-top-40">
                    <button type="submit" class="btn btn-danger email-submit registration-submit">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('custom-js')
    <script type="text/javascript">
        // save
        $(document).on("click", ".registration-submit", function(e) {
            e.preventDefault();
            var formData = new FormData($('#registration')[0]);
            var email = $('#sendEmail').val();
            var redirecturl = window.origin + '/user-verification?email=' + email;

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-top-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
                        $.ajax({
                url: window.origin + '/api/v1/auth/register',
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: formData,
                complete: function() {
                                $('.loading-spinner').css("display", "none");
                            },
                            success: function(res) {
                    toastr.success('Verification code send your mail. Please checked your mail', options);
                    setTimeout(window.location.href = redirecturl, 2000);
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
