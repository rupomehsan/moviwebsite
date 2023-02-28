@extends('frontend.layouts.client.index')
@section('content')
    <!-- video section start -->
    <section class="video ptb-90">
        <div class="container">
            <div class="row margin-top-40">
                <div class="col-md-6 profile-info">
                    <h2 class="margin-top-40">{{ $profile->name ?? '' }}</h2> <a href="/edit-profile"
                        class="edit-profile"><i class="fas fa-edit"></i></a>
                    <div class="margin-top-20 profile-info-detail"><i class="fas fa-phone-alt"></i>&nbsp; <span class="bold">Phone No :</span>
                        {{ $profile->phone ?? '' }}</div>
                    <div class="margin-top-20 profile-info-detail"><i class="far fa-envelope"></i>&nbsp; <span class="bold">Email :</span>
                        {{ $profile->email ?? '' }}</div>

                    {{-- <div class="edit-profile-section margin-top-40">
                        <button class="edit-profile-btn" data-toggle="modal" data-target="#modalProfile">Edit Profile</button>
                        <button class="change-password-btn">Change Password</button>
                    </div>     --}}
                </div>
                <div class="col-md-6 text-center profile-image">
                    @if (!empty($profile->image))
                        <img src="{{ URL::to('/') }}/uploads/user/{{ $profile->image }}" alt="{{ $profile->name }}"
                            title="{{ $profile->name }}" />
                    @else
                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                    @endif
                </div>
                <div class="col-md-6 text-center">
                </div>
            </div>
        </div>
    </section>
    <!-- video section end -->



    <!-- Start::Edit Profile Modal -->
    <div class="modal fade" id="modalProfile" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <div class="modal-title">
                        Edit Profile
                        <div class="modal-bottom-line margin-top-10"></div>
                    </div>
                </div>
                <div class="modal-body">
                    <form id="requestAddForm" method="POST" enctype="multipart/form-data">

                        <div class="form-group margin-top-20">
                            <input type="text" name="name" class="form-control create-form" id="name"
                                placeholder="Your Name*">
                        </div>
                        <div class="form-group margin-top-20">
                            <input type="text" name="email" class="form-control create-form" id="email"
                                placeholder="Your Email*">
                        </div>

                        <div class="actions margin-top-20 text-left">
                            <button class="submit" type="submit" id="addRequest">Update</button>
                            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- End::Edit Profile Modal -->
@endsection
@push('custom-js')
<script type="text/javascript">
    // Send Request
    $(document).on("click", ".edit-profile-btn", function(e) {
        e.preventDefault();
        var formData = new FormData($('#requestAddForm')[0]);

        var options = {
            closeButton: true,
            debug: false,
            positionClass: "toast-bottom-right",
            onclick: null
        };
        $('.loading-spinner').css("display", "flex");
        $.ajax({
            url: window.origin + 'send-movie-request',
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
                toastr.success('Send your request successfully!', res, options);
                $('#modalRequest').modal().hide();

            },
            error: function(jqXhr, ajaxOptions, thrownError) {
                if (jqXhr.status == 422) {
                    var errorsHtml = '';
                    var errors = jqXhr.responseJSON.message;
                    $.each(errors, function(key, value) {
                        errorsHtml += `<li>${value}</li>`
                    });
                    toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
                } else if (jqXhr.status == 500) {
                    toastr.error(jqXhr.responseJSON.message, '', options);
                } else {
                    toastr.error('Error', 'Something went wrong', options);
                }
                $('.loading-spinner').css("display", "none");
                App.unblockUI();
            }
        });
    });
</script>
@endpush
