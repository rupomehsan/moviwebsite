<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>

<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<!-- include FilePond plugins -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

<!-- include FilePond jQuery adapter -->
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}



<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{!! Toastr::message() !!}

{{-- drag image --}}
<script type="text/javascript" src="{{ asset('assets/js/imageUpload.js') }}"></script>

<script type="text/javascript">
    $(document).on("click", ".span-hide", function() {
      $(".sidebar-span").hide();
      $(".logo-icon").show();
      $(".side-bar").addClass('span-width-hide');
      $(".main-body").addClass('span-main-body-width-hide');
      $(".sidebar-span-btn").addClass('span-show');
      $(".sidebar-span-btn").removeClass('span-hide');
      $(".sidebar-span-btn").html('<span class="iconify" data-icon="fluent:text-grammar-arrow-right-24-filled"></span>');
    });
    $(document).on("click", ".span-show", function() {
      $(".sidebar-span").show();
      $(".logo-icon").hide();
      $(".main-body").removeClass('span-main-body-width-hide');
      $(".side-bar").removeClass('span-width-hide');
      $(".sidebar-span-btn").addClass('span-hide');
      $(".sidebar-span-btn").removeClass('span-show');
      $(".sidebar-span-btn").html('<span class="iconify" data-icon="fluent:text-grammar-arrow-left-24-filled"></span>');
    });
</script>

<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "f45a0b83-4ebe-435d-971d-8fa9ed4dda6e",
            safari_web_id: "web.onesignal.auto.13f7d09c-87f4-478e-9a86-b96c3b883b5b",
            notifyButton: {
                enable: true,
            },
            allowLocalhostAsSecureOrigin: true,
        });
    });
</script>

@stack("custom-js")
