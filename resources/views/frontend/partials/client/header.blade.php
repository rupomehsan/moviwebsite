<!DOCTYPE HTML>

<head>
    <?php
    $title = \App\Models\Setting::first();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="{{ $title->focus_keyword ?? '' }}" />
    <meta name="description" content="{{ $title->meta_description ?? '' }}" />
    @if ($title)
        <link rel="shortcut icon" type="image/jpg" href="{{ URL::to('/') }}/uploads/{{ $title->logo }}" />
        <title>{{ $title->system_name }}</title>
    @else
        <title>MovieFlix</title>
    @endif

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Favicon Icon -->
    {{-- <link rel="icon" type="image/png" href="{{asset('assets/img/favcion.png')}}" /> --}}
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" media="all" />
    <!-- Slick nav CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slicknav.min.css') }}" media="all" />
    <!-- Iconfont CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}" media="all" />
    <!-- Owl carousel CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Popup CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- Main style CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style2.css') }}" media="all" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" media="all" />
    <script src="https://code.iconify.design/2/2.0.4/iconify.min.js"></script>


    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <script src="https://unpkg.com/video.js/dist/video.js"></script>

</head>

<body>
    <div class="pannel-background">
        <img src="{{ URL::to('/') }}/uploads/back.png" alt="Background Image" />
    </div>

    {{-- Start::popup add --}}
    <?php
    $adds = \App\Models\WebAd::where('ad_type', 'popup')->first();
    ?>
    <div id="popupAdsPannel" class="popup-ads-hide" style="height:0px">
        <div class="popup-image-container">
            <div class="popup-image-holder" id="popupImageHolder">


                <button id="closePopup">
                    <i class="fas fa-times"></i>
                </button>
                <a href="{{ $adds->ad_link ?? '' }}" target="_blank">
                    @if (!empty($adds->image))
                        <img src="{{ URL::to('/') }}/uploads/ad/{{ $adds->image }}" alt="{{ $adds->ad_type }}"
                            title="{{ $adds->ad_type }}" style="width: 100%; height: 100%" />
                    @else
                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt=""
                            style="width: 100%; height: 100%" />
                    @endif

                    <div class="popup-click-here">Click Here</div>
                </a>
            </div>
        </div>
    </div>
    @if ($adds)
        <script>
            var clickCounter = parseInt(localStorage.getItem("clickCounter")) || 0;
            var adsData = "<?php echo $adds->show_per_video_category; ?>";
            if (clickCounter == adsData) {
                document.getElementById("popupAdsPannel").classList.add("popup-ads-pannel");
                document.getElementById("popupImageHolder").classList.add("show");
            }
        </script>
    @endif
    {{-- End::popup add --}}


    <?php
    $logo = \App\Models\Setting::first('logo');
    ?>
    <header class="header ">
        <div class="container">
            <div class="header-area">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        @if (!empty($logo->logo))
                            <img src="{{ URL::to('/') }}/uploads/{{ $logo->logo }}" alt="No Logo" />
                        @else
                            <img src="{{ URL::to('/') }}/uploads/logo.png" alt="" />
                        @endif
                    </a>
                </div>
                <div class="header-right">
                    <form action="/video/filter" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="submit"><i class="icofont icofont-search"></i></button>
                        <input name="search" type="text" placeholder="Seach Movie" />
                    </form>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/tv-channel-show') }}">Live TV</a></li>
                        <li><a href="{{ url('/category') }}">Explore</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#modalRequest">Request</a></li>
                        <li><a href="{{ url('/video') }}">Videos</a></li>
                        <li><a href="{{ url('/get-package') }}" class="package-btn">Package</a></li>

                        @if (empty(Auth()->id()))
                            <li>
                                <a class="contact-us-btn" href="/user/login">
                                    <span>LOGIN</span>
                                </a>
                            </li>
                        @endif
                        @if (!empty(Auth()->id()))
                            <li>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        @if (!empty(Auth::user()->image))
                                            <img src="{{ URL::to('/') }}/uploads/user/{{ Auth::user()->image }}"
                                                alt="{{ Auth::user()->name ?? '' }}" class="header-user-img"
                                                style="border-radius: 50%; height:40px;" width="40" />
                                        @else
                                            <img src="{{ URL::to('/') }}/uploads/no.jpeg" class="header-user-img"
                                                style="border-radius: 50%; height:40px;" width="40" />
                                        @endif
                                        {{ Auth::user()->name ?? '' }}
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="/profile" class="dropdown-item"><i class="fa fa-user mr-3"
                                                aria-hidden="true"></i>
                                            Profile</a>
                                        <a href="{{ url('/video?type=favourite') }}" class="dropdown-item"><i
                                                class="fa fa-heart mr-3" aria-hidden="true"></i>
                                            Favourite</a>
                                        <a href="/video?type=history" class="dropdown-item"><i
                                                class="fa fa-history mr-3" aria-hidden="true"></i>
                                            History</a>
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>

                </div>
                <div class="menu-area text-right">
                    @if (empty(Auth()->id()))
                        <div class="login-btn">
                            <a class="contact-us-btn" href="/user/login">
                                <span>LOGIN</span>
                            </a>
                        </div>
                    @endif
                    @if (!empty(Auth()->id()))
                        <div class="dropdown text-right">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                @if (!empty(Auth::user()->image))
                                    <img src="{{ URL::to('/') }}/uploads/user/{{ Auth::user()->image }}"
                                        alt="{{ Auth::user()->name ?? '' }}" class="header-user-img"
                                        style="border-radius: 50%; height:40px;" width="40" />
                                @else
                                    <img src="{{ URL::to('/') }}/uploads/no.jpeg" class="header-user-img"
                                        style="border-radius: 50%; height:40px;" width="40" />
                                @endif
                                <span class="dropdown-user-name">{{ Auth::user()->name ?? '' }}</span>
                            </a>
                            <div class="dropdown-menu">
                                <a href="/profile" class="dropdown-item"><i class="fa fa-user mr-3"
                                        aria-hidden="true"></i>
                                    Profile</a>
                                <a href="{{ url('/video?type=favourite') }}" class="dropdown-item"><i
                                        class="fa fa-heart mr-3" aria-hidden="true"></i> Favourite</a>
                                <a href="/video?type=history" class="dropdown-item"><i class="fa fa-history mr-3"
                                        aria-hidden="true"></i>
                                    History</a>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    @endif


                    <div class="responsive-menu"></div>
                    <div class="mainmenu">
                        <ul id="primary-menu">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/tv-channel-show') }}">Live TV</a></li>
                            <li><a class="active" href="{{ url('/category') }}">Explore</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modalRequest">Request</a></li>
                            <li><a href="{{ url('/video') }}">Videos</a></li>
                            <li><a href="{{ url('/get-package') }}" class="package-btn">Package</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!--Modal: Login / Register Form-->
    <div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Modal cascading tabs-->
                <div class="modal-c-tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i
                                    class="fas fa-user mr-1"></i>
                                Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i
                                    class="fas fa-user-plus mr-1"></i>
                                Register</a>
                        </li>
                    </ul>
                    <!-- Tab panels -->
                    <div class="tab-content">
                        <!--Login tab-->
                        <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
                            <div class="modal-body mb-1">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <img src="{{ asset('assets/img/xflix-logo.png') }}" class="mb-3"
                                        alt="" height="100" width="100"><br>

                                    <div class="md-form form-sm mb-5">
                                        <label data-error="wrong" data-success="right" for="modalLRInput10">
                                            <i class="fas fa-envelope prefix mr-3"></i>
                                            Email
                                        </label>

                                        <input type="email" id="modalLRInput10" name="email"
                                            class="form-control form-control-sm validate">
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <label data-error="wrong" data-success="right" for="modalLRInput11">
                                            <i class="fal fa-key mr-3"></i>
                                            Password
                                        </label>

                                        <input name="password" type="password" id="modalLRInput11"
                                            class="form-control form-control-sm validate">
                                    </div>

                                    <div class="text-center mt-2">
                                        <button type="submit" class="btn btn-info">Log in </button>
                                    </div>
                                </form>

                                <p> <a href="#" class="blue-text">Forgot Password?</a></p>
                                {{-- <p>Login With</a></p>

                                <ul class="link">
                                    <li><i class="fab fa-google"></i></li>
                                    <li><i class="fab fa-facebook-f"></i></li>
                                </ul>
                                <p>Need An Account ?</a></p>
                                <p><a href="#" class="blue-text">Register Now</a></p> --}}
                            </div>
                        </div>
                        <!--Login tab-->

                        <!--Registration tab-->
                        <div class="tab-pane fade" id="panel8" role="tabpanel">
                            <div class="modal-body">
                                <img src="{{ asset('assets/img/xflix-logo.png') }}" class="mb-3" alt=""
                                    height="100" width="100"><br>


                                <form id="registrationForm" method="POST" enctype="multipart/form-data">

                                    <div class="md-form form-sm mb-5">
                                        <label data-error="wrong" data-success="right" for="name"> <i
                                                class="fas fa-user mr-3"></i>Name</label>
                                        <input type="text" id="name" name="name"
                                            class="form-control form-control-sm validate">
                                    </div>

                                    <div class="md-form form-sm mb-5">
                                        <label data-error="wrong" data-success="right" for="email"> <i
                                                class="fas fa-envelope prefix mr-3"></i>Email</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-sm validate">
                                    </div>

                                    <div class="md-form form-sm mb-5">
                                        <label data-error="wrong" data-success="right" for="phone"> <i
                                                class="fas fa-phone-alt mr-3"></i>Phone</label>
                                        <input type="text" id="phone" name="phone"
                                            class="form-control form-control-sm validate">
                                    </div>

                                    <div class="md-form form-sm mb-4">
                                        <label data-error="wrong" data-success="right" for="password"> <i
                                                class="fal fa-key mr-3"></i></i>Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-sm validate">
                                    </div>

                                    <div class="text-center mt-2">
                                        <button type="submit" id="registrationStore"
                                            class="btn btn-info">Register</button>
                                    </div>

                                </form>
                                {{-- <p> <a href="#" class="blue-text">Forgot Password?</a></p>
                                <p>Login With</a></p>

                                <ul class="link">
                                    <li><i class="fab fa-google"></i></li>
                                    <li><i class="fab fa-facebook-f"></i></li>
                                </ul>
                                <p>NAlreay Have An Account ?</a></p>
                                <p><a href="#" class="blue-text">Login Now</a></p> --}}

                            </div>
                        </div>
                        <!--Registration tab-->
                    </div>

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: Login / Register Form-->

    <!-- Start::Add Request Modal -->
    <div class="modal fade" id="modalRequest" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <div class="modal-title">
                        Movie Request
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
                        <div class="form-group margin-top-20">
                            <input type="text" name="movie_name" class="form-control create-form" id="movie_name"
                                placeholder="Movie Name*">
                        </div>

                        <div class="form-group margin-top-20">
                            <textarea class="form-control create-form" id="message" name="message" rows="10"
                                placeholder="Write your message here"></textarea>
                        </div>

                        <div class="actions margin-top-20 text-left">
                            <button class="submit" type="submit" id="addRequest">Send</button>
                            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- End::Add Request Modal -->


    @push('custom-js')
        <script type="text/javascript">
            // Send Request
            $(document).on("click", "#addRequest", function(e) {
                e.preventDefault();
                // alert('kaj kor');
                var formData = new FormData($('#requestAddForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/send-movie-request',
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
                    }
                });
            });
        </script>
    @endpush
