 <!-- footer section start -->
 <footer class="footer">

     {{-- Start::Upper Footer --}}
     <div class="container">
         <div class="row">
             <div class="col-lg-4 col-sm-6 margin-top-20">
                 <?php
                 $logo = \App\Models\Setting::first();
                 ?>

                 <div class="widget">
                     <a href="{{ url('/') }}">
                         {{-- <img src="{{ asset('assets/img/xflix-logo.png') }}" alt="logo" /> --}}

                         @if (!empty($logo->logo))
                             <img src="{{ URL::to('/') }}/uploads/{{ $logo->logo }}" alt="No Logo" height="200"
                                 width="200" />
                         @else
                             <img src="{{ URL::to('/') }}/uploads/logo.png" alt="" height="200" width="200" />
                         @endif
                     </a>
                 </div>
             </div>

             <div class="col-lg-4 col-sm-6 margin-top-20">
                 <div class="row">
                     <div class="col-md-6">
                         <div class="legal-info"><a href="{{ url('/') }}">HOME</a></div>
                         <div class="legal-info"><a
                                 href="{{ url('/about-us') }}">ABOUT US</a></div>
                         {{-- <div class="legal-info"><a href="{{ url('/get-package') }}">CONTACT US</a></div> --}}
                         <div class="legal-info"><a href="{{ url('/get-package') }}">PACKAGES</a></div>
                     </div>
                     <div class="col-md-6">
                         <div class="legal-info"><a
                                 href="{{ url('/terms-conditions') }}">TERMS &
                                 CONDITIONS</a></div>
                         <div class="legal-info"><a
                                 href="{{ url('/privacy-policy') }}">PRIVACY
                                 POLICY</a></div>
                         <div class="legal-info"><a
                                 href="{{ url('/cookies-policy') }}">COOKIES
                                 POLICY</a></div>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4 col-sm-6 margin-top-20">
                 <div class="widget">
                     <h5>WANT TO KNOW ABOUT OFFERS</h5>
                     <div class="input-group sbscriber-add-area margin-top-20">
                         <input type="text" name="subscriber_email" id="subscriber_email" class="form-control" placeholder="Enter Email" aria-label="Enter Email"
                             aria-describedby="basic-addon2">
                         <div class="input-group-append">
                             <button type="button" id="subscriberAddBtn">Subscribe</button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <hr />
     </div>
     {{-- End::Upper Footer --}}

     {{-- Start::Lower Footer --}}
     <div class="low-footer-section container margin-top-20">
         <div class="row">
             <div class="col-md-4 margin-top-20">
                 <div class="copyright">
                     &copy; {{ date('Y') }} {{ $logo->system_name ?? 'MovieFlix' }} | Developed By
                     <a target="_blank" href="{{ $logo->website ?? '' }}">{{ $logo->developed_by ?? '' }}</a>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="row">
                     <div class="col-md-6 bold white margin-top-20">DOWNLOAD APP</div>
                     <div class="col-md-6 margin-top-20">
                         <a href="{{ $logo->update_app ?? '#' }}">
                             <span class="iconify" data-icon="logos:google-play"></span>
                         </a>
                     </div>
                 </div>
             </div>
             <div class="col-md-4 margin-top-20 social-area">
                 <div class="single-social">
                     <a target="_blank" href="{{ $logo->facebook ?? '#' }}">
                         <span class="iconify" data-icon="brandico:facebook"></span>
                     </a>
                 </div>
                 <div class="single-social">
                     <a target="_blank" href="{{ $logo->instagram ?? '#' }}">
                         <span class="iconify" data-icon="ant-design:instagram-filled"></span>
                     </a>
                 </div>
                 <div class="single-social">
                     <a target="_blank" href="{{ $logo->twitter ?? '#' }}">
                         <span class="iconify" data-icon="akar-icons:twitter-fill"></span>
                     </a>
                 </div>
                 <div class="single-social">
                     <a target="_blank" href="{{ $logo->youtube ?? '#' }}">
                         <span class="iconify" data-icon="akar-icons:youtube-fill"></span>
                     </a>
                 </div>
             </div>
         </div>
     </div>
     {{-- End::Lower Footer --}}
 </footer>
 <!-- footer section end -->
 <!-- jquery main JS -->
 <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
 <!-- Bootstrap JS -->
 <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
 <!-- Slick nav JS -->
 <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>
 <!-- owl carousel JS -->
 <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
 <!-- Popup JS -->
 <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
{{-- sweet alert  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <!-- Isotope JS -->
 <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
  integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 {!! Toastr::message() !!}
 <!-- main JS -->
 <script src="{{ asset('assets/js/main.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
 {{-- //for popup ads --}}
 <?php
 $adds = \App\Models\WebAd::where('ad_type', 'popup')->first();
 ?>
 

 @if ($adds)
     <script>
         //close popup
         $(document).on("click", "#closePopup", function() {
             $("#popupAdsPannel").removeClass('popup-ads-pannel');
             $("#popupImageHolder").removeClass('show');
         });

         //click Counter
         $(document).on("click", "button, a", function() {
             var clickCounter = parseInt(localStorage.getItem("clickCounter")) || 0;
             var adsData = "<?php echo $adds->show_per_video_category; ?>";
             if (clickCounter >= adsData) {
                 clickCounter = 0;
                 parseInt(localStorage.setItem("clickCounter", 0));
             }
             clickCounter += 1;
             parseInt(localStorage.setItem("clickCounter", clickCounter));
             //  alert(clickCounter);
         });
     </script>
 @endif
 <script>
     // registration store
     $(document).on("click", "#registrationStore", function(e) {
         e.preventDefault();
         var formData = new FormData($('#registrationForm')[0]);

         var options = {
             closeButton: true,
             debug: false,
             positionClass: "toast-bottom-right",
             onclick: null
         };
         $('.loading-spinner').css("display", "flex");
         $.ajax({
             url: window.origin + '/user/registration',
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
                 toastr.success('Registration successfully done!', res, options);
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

     // subscriber add
     $(document).on("click", "#subscriberAddBtn", function(e) {
         e.preventDefault();
         var email = $('#subscriber_email').val();
         if(email == ''){
             return false;
         }
        //  alert(email);

         var options = {
             closeButton: true,
             debug: false,
             positionClass: "toast-bottom-right",
             onclick: null
         };
         $('.loading-spinner').css("display", "flex");
         $.ajax({
             url: window.origin + '/subscriber',
             type: 'POST',
             dataType: "json",
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             data: {
                email : email
             },
             complete: function() {
                 $('.loading-spinner').css("display", "none");
             },
             success: function(res) {
                 toastr.success('Congrartulations! You have been successfully subscribed.', res, options);
                 setTimeout(location.reload.bind(location), 3000);
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
 @stack('custom-js')
 </body>

 </html>
