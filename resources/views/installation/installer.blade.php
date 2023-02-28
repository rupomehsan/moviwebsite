<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="shortcut icon" type="image/jpg" href="{{ URL::to('/') }}/uploads/{{ $title->logo }}" /> --}}
    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="custom.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            background-color: #F0F0F0;
        }

        .wizard {
            width: 100%;
            height: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #8adde2;
            padding: 70px;
        }

        .wizard .nav-tabs {
            position: relative;
            border: 0px;
        }




        .round4 {
            border-radius: 0px 10px 10px 0px !important;
        }

        .list-inline {
            text-align: center;
        }

        .stepactive1 a,
        .stepactive2 a,
        .stepactive3 a,
        .stepactive4 a,
        .stepactive2 a span,
        .stepactive3 a span,
        .stepactive4 a span,
        .stepactive1 a span {
            width: 100%;
        }

        .next-step:hover,
        .next-step,
        .prev-step:hover,
        .prev-step {
            position: relative;
            background-color: #2ED4E0;
            font-size: 16px;
            color: #FFFFFF;
            margin-top: 30px;
        }

        span.round-tab {
            width: 70px !important;
            height: 70px !important;
            line-height: 70px;
            display: inline-block;
            border-radius: 50%;
            background: #8ADDE2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 25px;
            color: #1197A0;
        }

        .wizard li.active span.round-tab {
            background: #2ED4E0;
            color: white;
        }

        span.round-tab:hover {
            color: #fff;
            background: #2ED4E0;
        }

        .wizard .nav-tabs>li {
            margin-left: 27px;
            width: 10%;
        }

        .nav-tabs>li {
            float: left;
            margin-bottom: -1px;
            margin-top: 75px;
        }

        .wizard .nav-tabs>li a {
            width: 70px;
            color: #E0C8D8;
            height: 70px;
            margin: 20px auto;
            border-radius: 100%;
            padding: 0;
        }

        .wizard .nav-tabs>li a:hover {
            background: transparent;
        }

        .wizard .tab-pane {
            position: relative;

        }

        @media(min-width : 320px) and (max-width : 765px) {
            .wizard {
                width: 90%;
                height: auto !important;
                margin: auto;
            }

            span.round-tab {
                font-size: 16px;
                width: 50px;
                height: 50px;
                line-height: 50px;
            }

            .wizard .nav-tabs>li a {
                width: 50px;
                height: 50px;
                line-height: 50px;
            }

            .round1,
            .round2,
            .round3,
            .round4 {
                font-size: 10px !important;
            }
        }

        .wizard-inner {
            width: 70%;
            margin: 0 auto;
            position: relative;
            background: white;
        }

        h1 {
            font-size: 20px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            color: white;
            font-size: 20px;
            padding: 40px 0px;
        }

        .wrapper {
            position: absolute;
            height: 130px;
            width: 100%;
            background: linear-gradient(180deg, #2ED4E0 19.34%, #25B7C1 100%);
        }

        form {
            padding: 0px 20px;
        }

    </style>
</head>

<body>

    <section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="wrapper">
                    <div class="title">Welcome To The Installation</div>
                </div>
                <div class="connecting-line">

                </div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active stepactive0">
                        <a href="#step0" data-toggle="tab" aria-controls="step0" role="tab" title="Step 0">
                            <span class="round-tab round0">
                                <span class="iconify" data-icon="akar-icons:home"></span>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class=" stepactive1">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab round1">
                                <span class="iconify" data-icon="clarity:vmw-app-line"></span>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled stepactive2">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab round2">
                                <span class="iconify" data-icon="dashicons:database-import"></span>
                            </span>
                        </a>
                    </li>
                    {{-- <li role="presentation" class="disabled stepactive4">
                        <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
                            <span class="round-tab round5">
                                <span class="iconify" data-icon="fluent:calendar-mail-20-regular"></span>
                            </span>
                        </a>
                    </li> --}}
                    <li role="presentation" class="disabled stepactive3">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab round3">
                                <span class="iconify" data-icon="emojione-monotone:locked-with-key"></span>
                            </span>
                        </a>
                    </li>
                    {{-- <li role="presentation" class="disabled stepactive5">
                        <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5">
                            <span class="round-tab round5">
                                <span class="iconify" data-icon="flat-ui:key"></span>
                            </span>
                        </a>
                    </li> --}}
                    <li role="presentation" class="disabled stepactive6">
                        <a href="#step6" data-toggle="tab" aria-controls="step6" role="tab" title="Step 6">
                            <span class="round-tab round5">
                                <span class="iconify" data-icon="ant-design:file-done-outlined"></span>
                            </span>
                        </a>
                    </li>
                </ul>

                <form role="form">
                    <div class="tab-content">

                        <div class="tab-pane active" role="tabpanel" id="step0">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Welcome To The Setup Wizard</h1>
                                </div>
                            </div>
                            <ul class="list-inline text-center">
                                <li><button type="button" class="btn next-step next-step-action">Next <i
                                            class="fa fa-arrow-right"></i></button></li>
                            </ul>
                        </div>

                        <form id="newsCreateForm" method="POST" enctype="multipart/form-data" action="">
                            <div class="tab-pane " role="tabpanel" id="step1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1>App Configaration</h1>
                                        @csrf

                                        <div class="form-group">
                                            <label for="title">APP NAME</label>
                                            <input class="form-control create-form" id="app_name" name="app_name"
                                                value="{{ env('APP_NAME') }}" rows="0" placeholder="APP NAME">
                                            <span class="text-danger"></span>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="title">APP ENV</label>
                                            <input class="form-control create-form" id="app_env" name="app_env"
                                                placeholder="APP ENV" value="{{ env('APP_ENV') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">APP DEBUG</label>
                                            <select name="app_debug" id="app_debug" class="form-control">
                                                <option value="true" {{ env('app_debug' ? 'selected' : '') }}>True
                                                </option>
                                                <option value="false" {{ env('app_debug' ? 'selected' : '') }}>False
                                                </option>
                                            </select>
                                            <span class="text-danger"></span>
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="title">APP URL</label>
                                            <input class="form-control create-form" id="app_url" name="app_url" rows="0"
                                                placeholder="App URL" value="{{ env('APP_URL') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-inline text-center">
                                    <li>
                                        <button type="button" class="btn prev-step"><i
                                                class="fa fa-arrow-left"></i>  Previous</button>
                                    </li>
                                    <li>
                                        <button id="appConfigureNextBtn" type="button"
                                            class="btn btn-info-full next-step">Save and Next  <i
                                                class="fa fa-arrow-right"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </form>

                        <div class="tab-pane" role="tabpanel" id="step2">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Database Configaration</h1>
                                    <form id="newsCreateForm" method="POST" enctype="multipart/form-data" action="">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">DATABASE NAME</label>
                                            <input class="form-control create-form" id="db_name" name="db_name" rows="0"
                                                placeholder="DATABASE NAME" value="{{ env('DB_DATABASE') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">DATABSE USERNAME</label>
                                            <input class="form-control create-form" id="db_username" name="db_username"
                                                rows="0" placeholder="DATABSE USERNAME"
                                                value="{{ env('DB_USERNAME') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">DATABASE PASSWORD</label>
                                            <input class="form-control create-form" id="db_password" name="db_password"
                                                rows="0" placeholder="DATABASE PASSWORD"
                                                value="{{ env('DB_PASSWORD') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">DATABASE HOST</label>
                                            <input class="form-control create-form" id="db_host" name="db_host" rows="0"
                                                placeholder="DATABASE HOST" value="{{ env('DB_HOST') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">DATABASE PORT</label>
                                            <input class="form-control create-form" id="db_port" name="db_port" rows="0"
                                                placeholder="DATABASE PORT" value="{{ env('DB_PORT') }}">
                                            <span class="text-danger"></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <ul class="list-inline text-center">
                                <li><button type="button" class="btn prev-step"><i
                                            class="fa fa-arrow-left"></i>  Previous</button></li>
                                <li><button type="button" id="dbConfigureNextBtn" class="btn next-step">Save and
                                        Next  <i class="fa fa-arrow-right"></i></button></li>
                            </ul>
                        </div>

                        <div class="tab-pane" role="tabpanel" id="step3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Codecanyon Licence Key </h1>
                                    <form id="newsCreateForm" method="POST" enctype="multipart/form-data" action="">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">LICENCE KEY</label>
                                            <input class="form-control create-form" id="canion_li_key" name="title"
                                                rows="0" placeholder="LICENCE KEY">
                                            <span class="text-danger"></span>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <ul class="list-inline text-center">
                                <li><button type="button" class="btn prev-step"><i
                                            class="fa fa-arrow-left"></i>Previous</button></li>
                                <li><button type="button" id="ccConfigNxtBtn" class="btn btn-info-full next-step">Save
                                        and
                                        Next  <i class="fa fa-arrow-right"></i></button></li>
                            </ul>
                        </div>

                        {{-- <div class="tab-pane" role="tabpanel" id="step4">
                            <div class="col-md-12">
                                <h1>Mail Configaration </h1>
                                <form id="newsCreateForm" method="POST" enctype="multipart/form-data" action="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">MAIL MAILER</label>
                                        <input class="form-control create-form" id="mail_mailer" name="mail_mailer"
                                            value="{{ env('MAIL_MAILER') }}" placeholder="Mail Mailer">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">MAIL HOST</label>
                                        <input class="form-control create-form" id="mail_host" name="mail_host"
                                            value="{{ env('MAIL_HOST') }}" placeholder="Mail Host">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">MAIL PORT</label>
                                        <input class="form-control create-form" id="mail_port" name="mail_port"
                                            value="{{ env('MAIL_PORT') }}" placeholder="Mail Port">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="title"> MAIL USERNAME</label>
                                        <input class="form-control create-form" id="mail_username" name="mail_username"
                                            value="{{ env('MAIL_USERNAME') }}" placeholder="Mail Username">
                                        <span class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">MAIL PASSWORD</label>
                                        <input class="form-control create-form" id="mail_password" name="mail_password"
                                            value="{{ env('MAIL_PASSWORD') }}" placeholder="Mail Password">
                                        <span class="text-danger"></span>
                                    </div>
                                </form>
                            </div>
                            <ul class="list-inline text-center">
                                <li>
                                    <button type="button" class="btn prev-step">
                                        <i class="fa fa-arrow-left"></i>  Previous
                                    </button>
                                </li>
                                <li>
                                    <button type="button" id="mailConfigureNextBtn"
                                        class="btn btn-info-full next-step">
                                        Save and Next <i class="fa fa-arrow-right"></i>
                                    </button>
                                </li>
                            </ul>
                        </div> --}}

                        {{-- <div class="tab-pane" role="tabpanel" id="step5">
                            <div class="col-md-12">
                                <h1>Our Licence Key</h1>
                                <form id="newsCreateForm" method="POST" enctype="multipart/form-data" action="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">LICENCE KEY</label>
                                        <input class="form-control create-form" id="our_li_key" name="our_li_key"
                                            rows="0" placeholder="LICENCE KEY">
                                        <span class="text-danger"></span>
                                    </div>

                                </form>
                            </div>
                            <ul class="list-inline text-center">
                                <li><button type="button" class="btn prev-step"><i
                                            class="fa fa-arrow-left"></i>  Previous</button></li>
                                <li><button type="button" class="btn btn-info-full next-step next-step-action">Save and
                                        Submit <i class="fa fa-arrow-right"></i></button></li>
                            </ul>
                        </div> --}}

                        <div class="tab-pane" role="tabpanel" id="step6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1> <b> Congratulations!</b> You have completed the installation!</h1>
                                </div>
                            </div>
                            <ul class="list-inline text-center">
                                <li><button type="button" id="configFinishedBtn"
                                        class="btn next-step next-step-action">Finised</button></li>
                            </ul>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </form>

            </div>
        </div>
    </section>


    {{-- -- footer part -- --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- {!! Toastr::message() !!} --}}
    <script>
        $(document).ready(function() {
            $('.nav-tabs > li a[title]').tooltip();
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                var $target = $(e.target);
                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });
            $(".next-step-action").click(function(e) {
                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);
            });
            $(".prev-step").click(function(e) {
                var $active = $('.wizard .nav-tabs li.active');
                prevTab($active);
            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }

        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }


        //App Configuration Update
        $(document).on("click", "#appConfigureNextBtn", function(e) {
            e.preventDefault();

            var appName = $('#app_name').val();
            // var appEnv = $('#app_env').val();
            // var appDebug = $('#app_debug').val();
            var appUrl = $('#app_url').val();

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'installation/env-update',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    app_name: appName,
                    // app_env: appEnv,
                    // app_debug: appDebug,
                    app_url: appUrl,
                },
                complete: function() {
                                $('.loading-spinner').css("display", "none");
                            },
                            success: function(res) {
                    toastr.success('App Information Updated successfully');

                    var $active = $('.wizard .nav-tabs li.active');
                    $active.next().removeClass('disabled');
                    nextTab($active);
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
                        toastr.error(jqXhr.responseJSON.message, '');
                    } else {
                        toastr.error('Error', 'Something went wrong');
                    }
                                $('.loading-spinner').css("display", "none");
                }
            });
        });

        //Database Configuration Update
        $(document).on("click", "#dbConfigureNextBtn", function(e) {
            e.preventDefault();

            var dbName = $('#db_name').val();
            var dbUsername = $('#db_username').val();
            var dbPassword = $('#db_password').val();
            var dbHost = $('#db_host').val();
            var dbPort = $('#db_port').val();
            // alert(appUrl);

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'installation/env-update',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    db_name: dbName,
                    db_username: dbUsername,
                    db_password: dbPassword,
                    db_host: dbHost,
                    db_port: dbPort,
                },
                complete: function() {
                                $('.loading-spinner').css("display", "none");
                            },
                            success: function(res) {
                    // toastr.success('Database Information Updated successfully');
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    if (jqXhr.status == 422) {
                        var errorsHtml = '';
                        var errors = jqXhr.responseJSON.message;
                        $.each(errors, function(key, value) {
                            errorsHtml += `<li>${value}</li>`
                        });
                        toastr.error(errorsHtml, jqXhr.responseJSON.heading,
                            options);
                    } else if (jqXhr.status == 500) {
                        toastr.error(jqXhr.responseJSON.message, '');
                    } else {
                        toastr.error('Error', 'Something went wrong');
                    }
                                $('.loading-spinner').css("display", "none");
                }
            });

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'installation/db-check',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    db_name: dbName,
                    db_username: dbUsername,
                    db_password: dbPassword,
                    db_host: dbHost,
                    db_port: dbPort,
                },
                complete: function() {
                                $('.loading-spinner').css("display", "none");
                            },
                            success: function(res) {
                    toastr.success(res.message);

                    var $active = $('.wizard .nav-tabs li.active');
                    $active.next().removeClass('disabled');
                    nextTab($active);
                },
                error: function(res) {
                    toastr.error(res.responseJSON.message);
                                $('.loading-spinner').css("display", "none");
                }
            });
        });

        //Code Caniyon Configuration Update
        $(document).on("click", "#ccConfigNxtBtn", function(e) {
            e.preventDefault();

            var code = $('#canion_li_key').val();
            // alert(appUrl);

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'installation/license-checker',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    code
                },
                complete: function() {
                                $('.loading-spinner').css("display", "none");
                            },
                            success: function(res) {
                    if (res.status === 'success') {
                        toastr.success(res.message);
                        var $active = $('.wizard .nav-tabs li.active');
                        $active.next().removeClass('disabled');
                        nextTab($active);
                    } else if (res.status === 'validate_error') {
                        toastr.error(res.data['code']);
                    } else if (res.status === 'server_error') {
                        toastr.error(res.message);
                    }
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    if (jqXhr.status == 422) {
                        var errorsHtml = '';
                        var errors = jqXhr.responseJSON.message;
                        $.each(errors, function(key, value) {
                            errorsHtml += `<li>${value}</li>`
                        });
                        toastr.error(errorsHtml, jqXhr.responseJSON.heading,
                            options);
                    } else if (jqXhr.status == 500) {
                        toastr.error(jqXhr.responseJSON.message, '');
                    } else {
                        toastr.error('Error', 'Something went wrong');
                    }
                                $('.loading-spinner').css("display", "none");
                }
            });
        });

        //Mail Configuration Update
        $(document).on("click", "#mailConfigureNextBtn", function(e) {
            e.preventDefault();

            var mailMailer = $('#mail_mailer').val();
            var mailHost = $('#mail_host').val();
            var mailPort = $('#mail_port').val();
            var mailUsername = $('#mail_username').val();
            var mailPassword = $('#mail_password').val();
            // alert(appUrl);

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'installation/env-update',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    mail_mailer: mailMailer,
                    mail_host: mailHost,
                    mail_port: mailPort,
                    mail_username: mailUsername,
                    mail_password: mailPassword,
                },
                complete: function() {
                                $('.loading-spinner').css("display", "none");
                            },
                            success: function(res) {
                    toastr.success('Mail Information Updated successfully');

                    var $active = $('.wizard .nav-tabs li.active');
                    $active.next().removeClass('disabled');
                    nextTab($active);
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
                        toastr.error(jqXhr.responseJSON.message, '');
                    } else {
                        toastr.error('Error', 'Something went wrong');
                    }
                                $('.loading-spinner').css("display", "none");
                }
            });
        });

        //Mail Configuration Update
        $(document).on("click", "#configFinishedBtn", function(e) {
            e.preventDefault();
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'installation/finished',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                complete: function() {
                                $('.loading-spinner').css("display", "none");
                            },
                            success: function(res) {
                    toastr.success('Installation process successfully complete..!!');

                    window.location.href = "/";
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
                        toastr.error(jqXhr.responseJSON.message, '');
                    } else {
                        toastr.error('Error', 'Something went wrong');
                    }
                                $('.loading-spinner').css("display", "none");
                }
            });
        });
    </script>
</body>

</html>
