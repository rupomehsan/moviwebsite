@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <div class="row">
                    <div class="col-md-2">
                        <span class="title">
                            <a href="/admin/sponsor" class="title-btn">Sponsor Banner</a>
                        </span>
                        <div class="title-line category-title-line display-none" id="categoryLine"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="sub-title">
                            <a href="/admin/sponsor/sponsor-video-index" class="title-btn red">Sponsor Video</a>
                        </span>
                        <div class="title-line sub-category-title-line"></div>
                    </div>
                </div>


                <div class="row create-menus margin-top-10">
                    <div class="col-md-3">
                        <button type="button" class=" margin-top-10" data-toggle="modal" data-target="#createModal"
                            id="sponsorVideoCreate">
                            <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Add Sponsor Video
                        </button>
                    </div>

                </div>
            </div>
            {{-- title --}}

            {{-- search --}}
            <div class="col-md-4 text-right">
                <form action="/admin/sponsor/sponsor-video-filter" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group content-search">
                        <button class="input-group-text search" id="addon-wrapping">
                            <span class="iconify" data-icon="bx:bx-search"></span>
                        </button>
                        <input name="fil_search" type="text" class="form-control search" placeholder="Search"
                            aria-label="fil_search">
                    </div>
                </form>
            </div>
            {{-- search --}}
        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}
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
    <div class="row content-details">

        @if (!$target->isEmpty())
            @foreach ($target as $data)
                <div class="margin-top-20 col-md-2">
                    <div class="content-image text-center">
                        @if ($data->file_type == 'link')
                            <img src="{{ $data->file_link }}" alt="{{ $data->name }}" title="{{ $data->name }}" />
                        @else
                            @if (!empty($data->image))
                                <img src="{{ URL::to('/') }}/uploads/sponsor/{{ $data->image }}" alt="{{ $data->title }}"
                                    title="{{ $data->title }}" />
                            @else
                                <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                            @endif
                        @endif
                    </div>
                    <div class="content-name margin-top-10 text-center">
                        <span class="bold">{{ $data->title }}</span>
                    </div>

                    {{-- <div class="country-action text-center margin-top-10">

                        <button title="Edit" type="button" data-toggle="modal" data-target="#createModal" id="editBtn"
                            data-id="{{ $data->id }}">
                            <span class="iconify" data-icon="ant-design:edit-filled"></span>
                        </button>&nbsp;&nbsp;

                        <button type="button" title="Delete" id="deleteItem" data-id={{ $data->id }}>
                            <span class="iconify" data-icon="ant-design:delete-filled"></span>
                        </button>

                    </div> --}}

                    <div class="actions-area">
                        <button type="button" class="btn action-span" data-toggle="dropdown" aria-haspopup="false"
                            aria-expanded="false">
                            <span class="iconify" data-icon="charm:menu-kebab"></span>
                        </button>
                        <div class="dropdown-menu single-content-wraper">
                            <button title="Edit" class="popup-action-button" type="button" data-toggle="modal"
                                data-target="#createModal" id="editBtn" data-id="{{ $data->id }}"><span
                                    class="iconify" data-icon="ant-design:edit-filled"></span> Edit
                                Sponsor</button>
                            <button type="button" class="popup-action-button" id="deleteItem" data-id={{ $data->id }}
                                title="Delete">
                                <span class="iconify" data-icon="ant-design:delete-filled"></span> Delete Sponsor
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
    {{-- End::Content Body --}}


    {{-- create  modals --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="createModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal"></div>
        </div>
    </div>


@stop
@push('custom-js')
    <script type="text/javascript">
        $(function() {

            //delete
            $(document).on("click", "#deleteItem", function(e) {
                e.preventDefault();
                var id = $(this).attr("data-id");
                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };

                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.loading-spinner').css("display", "flex");
                        $.ajax({
                            url: window.origin +
                                '/admin/sponsor/destroy/sponsor-video-index',
                            type: "POST",
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: id,
                            },
                            complete: function() {
                                $('.loading-spinner').css("display", "none");
                            },
                            success: function(res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                setTimeout(location.reload.bind(location), 1000);
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
                                } else if (jqXhr.status == 401) {
                                    toastr.error('Sorry, You can not delete this item',
                                        'Authentication Error', options);
                                } else if (jqXhr.status == 500) {
                                    toastr.error(jqXhr.responseJSON.message, '',
                                        options);
                                } else {
                                    toastr.error('Error', 'Something went wrong',
                                        options);
                                }
                                $('.loading-spinner').css("display", "none");
                            }
                        }); //ajax
                    }
                });

            });

            //sponsor banner create Modal
            $(document).on("click", "#sponsorBannerCreate", function(e) {
                e.preventDefault();
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/sponsor/sponsor-banner-create',
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

            //sponsor banner save
            $(document).on("click", "#createSponsorBanner", function(e) {
                e.preventDefault();
                var formData = new FormData($('#sponsorBannerCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/sponsor/sponsor-banner-store',
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
                        toastr.success('Sponsor Banner Added successfully', res, options);
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



            // sponsor video create Modal
            $(document).on("click", "#sponsorVideoCreate", function(e) {
                e.preventDefault();
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/sponsor/sponsor-video-create',
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

            // sponsor video save
            $(document).on("click", "#createSponsorVideo", function(e) {
                e.preventDefault();
                var formData = new FormData($('#sponsorVideoCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/sponsor/sponsor-video-store',
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
                        toastr.success('Sponsor Video Added successfully', res, options);
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

            //sponsor video edit Modal
            $(document).on("click", "#editBtn", function(e) {
                e.preventDefault();
                var id = $(this).attr("data-id");
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/sponsor/sponsor-video-edit',
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
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

            // sponsor video update
            $(document).on("click", "#editSponsorVideo", function(e) {
                e.preventDefault();
                var formData = new FormData($('#sponsorVideoEditForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/sponsor/sponsor-video-update',
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
                        toastr.success('Sponsor Video updated successfully', res, options);
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
                        } else if (jqXhr.status == 401) {
                            toastr.error('Sorry, You can not update this item',
                                'Authentication Error', options);
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

            //file input type select
            $(document).on("change", "#upload_type", function() {
                var value = $(this).val();
                if (value == 'link') {
                    $('#fileLinkSection').show();
                    $('.file-upload').hide();
                    $('.file-upload-edit').hide();
                }
                if (value == 'file') {
                    $('#fileLinkSection').hide();
                    $('.file-upload-edit').show();
                }
            });

        });
    </script>
@endpush
