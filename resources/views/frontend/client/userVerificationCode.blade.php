@extends('frontend.layouts.client.index')
@section('content')
    <div class="frontend-login-pannel row margin-top-150">
        <div class="frontend-login-title col-md-12 text-center">Please Verify Your Email</div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form id="verification" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="email" id='sendEmail' value="{{ request('email') }}">

                <div class="input-group mb-3">
                    <div class="input-group-prepend vrification-code">
                        <span class="input-group-text" id="basic-addon1">Verification Code</span>
                    </div>

                    <input id="code" type="code" class="form-control @error('code') is-invalid @enderror"
                        name="verification_code" placeholder="Enter Verification code" required autocomplete="code"
                        aria-describedby="basic-addon1">
                </div>

                <div class="form-group text-center margin-top-40">
                    <button type="submit" class="btn btn-danger email-submit code-submit">
                        Send
                    </button>
                </div>
            </form>

            <div class="row forgot-registration">
                <div class="col-md-6">
                    <p> <a href="#" id="resend" class="blue-text">Resend Code</a></p>
                </div>
                {{-- <div class="col-md-6 text-right">
                    <p>Need An Account ?</a></p>
                    <p><a href="/registration" class="blue-text">Register Now</a></p>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
    <script type="text/javascript">
        // save
        $(document).on("click", ".code-submit", function(e) {
            e.preventDefault();
            var formData = new FormData($('#verification')[0]);
            // alert(formData);
            var email = $('#sendEmail').val();
            var redirecturl = window.origin + '/';

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-top-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/api/v1/auth/phone-verification',
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
                    toastr.success('Verification successfully done.. Please login your account',
                        options);
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

        //resend
        $(document).on("click", "#resend", function(e) {
            e.preventDefault();
            var email = $('#sendEmail').val();
            // alert(email);
            var redirecturl = window.origin + '/forgot-password?email=' + email;

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-top-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/api/v1/auth/resend-code-verification',
                type: 'patch',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    email: email
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    toastr.success('Verification code send your mail. Please checked your mail',
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
