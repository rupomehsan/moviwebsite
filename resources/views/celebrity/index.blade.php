@extends('layouts.default.master')
@section('data_count')


    <?php
    $checked = 'checked';
    $class = '';
    $offText = 'display-none';
    if (!empty($mgtStatus)) {
        if ($mgtStatus->status == 'off') {
            $checked = '';
            $class = 'display-none';
            $offText = '';
        }
    }
    ?>
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-7 content-title">
                <div class="content-title-body">
                    <span class="title">Artist</span>
                    <div class="title-line"></div>
                </div>

                <input type="checkbox" name="symbole" data-id="celebrity" class="switch" id="pannelStatus" {{ $checked }}>

            </div>
            {{-- title --}}

            {{-- search --}}
            <div class="col-md-5 text-right pannel-status {{ $class }}">

                <form action="/admin/celebrity/filter" method="POST" enctype="multipart/form-data">
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

        <div class="action-buttons">
            <button type="button" class="margin-top-10 single-action pannel-status {{ $class }}" data-toggle="modal"
                data-target="#crateModal" id="crateBtn">
                <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Add Artist
            </button>

            <button type="button" class="margin-top-10 single-action pannel-status {{ $class }}" data-toggle="modal"
                data-target="#xlModal" id="manageCelebrityType">
                <span class="iconify" data-icon="carbon:user-settings"></span>&nbsp;Manage Artist Type
            </button>
        </div>
    </div>
    {{-- End:: content heading --}}

    <div class="pannel-status {{ $class }}">
        {{-- Start::Content Body --}}
        {{-- content top --}}
        <div class="row margin-top-20">
            @if (!$celebrityType->isEmpty())
                @foreach ($celebrityType as $data)
                    <?php
                    $contentActive = '';
                    if ($data->id == Request::get('id')) {
                        $contentActive = 'content-type-active';
                    }
                    if (empty(Request::get('id')) && $data->id == $firstType->id) {
                        $contentActive = 'content-type-active';
                    }
                    ?>
                    <div class="col-md-2 content-type">
                        <div class="content-type-element {{ $contentActive }}">
                            <a href="/admin/celebrity/index-view?id={{ $data->id }}"
                                class="bold">{{ $data->name }}</a>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        {{-- content top --}}
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
            {{-- celebrity --}}

            @if ($target)
                @foreach ($target as $data)
                    <div class="col-md-2 margin-top-20">
                        <div class="content-image text-center">
                            @if ($data->file_type == 'link')
                                <img src="{{ $data->file_link }}" alt="{{ $data->name }}" title="{{ $data->name }}" />
                            @else
                                @if (!empty($data->image))
                                    <img src="{{ URL::to('/') }}/uploads/celebrity/{{ $data->image }}"
                                        alt="{{ $data->name }}" title="{{ $data->name }}" />
                                @else
                                    <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                                @endif
                            @endif
                        </div>
                        <div class="content-name margin-top-10 text-center">
                            <span class="bold">{{ $data->name }}</span>
                        </div>
                        <div class="content-type-name margin-top-10 text-center">
                            <span>{{ $data->celebrity_type }}</span>
                        </div>
                        {{-- <div class="country-action text-center margin-top-10">

                            <button title="Edit" class="popup-action-button" type="button" data-toggle="modal" data-target="#crateModal" id="editBtn"
                                data-id="{{ $data->id }}">
                                <span class="iconify" data-icon="ant-design:edit-filled"></span>
                            </button>&nbsp;&nbsp;

                            <button type="button" class="popup-action-button" title="Delete" id="deleteItem" data-id={{ $data->id }}>
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
                                    data-target="#crateModal" id="editBtn" data-id="{{ $data->id }}">
                                    <span class="iconify" data-icon="ant-design:edit-filled"></span> Edit Artist
                                </button>

                                <button type="button" class="popup-action-button" title="Delete" id="deleteItem"
                                    data-id={{ $data->id }}>
                                    <span class="iconify" data-icon="ant-design:delete-filled"></span> Delete Artist
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        {{-- End::Content Body --}}
    </div>

    <div class="off-text-content {{ $offText }}"> This function are currentlly off..!</div>





    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="crateModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal">

            </div>
        </div>
    </div>

    {{-- fuul modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="xlModal">
        <div class="modal-dialog modal-lg">
            <div id="showXlModal">

            </div>
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
                            url: window.origin + '/admin/celebrity/destroy',
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
            //pannel status
            $(document).on("change", "#pannelStatus", function(e) {
                e.preventDefault();
                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                var name = $(this).data('id');

                if ($(this).prop('checked')) {
                    var properties = 'on'
                    $(".pannel-status").show();
                    $(".off-text-content").hide();
                } else {
                    var properties = 'off'
                    $(".pannel-status").hide();
                    $(".off-text-content").show();
                }
                // $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/management-status',
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        name: name,
                        status: properties,
                    }
                }); //ajax
            });

            // create Modal
            $(document).on("click", "#crateBtn", function(e) {
                e.preventDefault();
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/celebrity/create',
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

            // edit Modal
            $(document).on("click", "#editBtn", function(e) {
                e.preventDefault();
                var id = $(this).attr("data-id");
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/celebrity/edit',
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

            // save
            $(document).on("click", "#createCelebrity", function(e) {
                e.preventDefault();
                var formData = new FormData($('#celebrityCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/celebrity/store',
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
                        toastr.success('Artist Added successfully', res, options);
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

            // edit
            $(document).on("click", "#editCelebrity", function(e) {
                e.preventDefault();
                var formData = new FormData($('#celebrityEditForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/celebrity/update',
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
                        toastr.success('Artist updated successfully', res, options);
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


            // manage celebrity type Modal
            $(document).on("click", "#manageCelebrityType", function(e) {
                e.preventDefault();
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/celebrity/manage-celebrity-type',
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    complete: function() {
                        $('.loading-spinner').css("display", "none");
                    },
                    success: function(res) {
                        $("#showXlModal").html(res.html);
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {
                        $('.loading-spinner').css("display", "none");
                    }
                }); //ajax
            });

            $(document).on("click", "#typeCreateBtn", function(e) {
                e.preventDefault();
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/celebrity/celebrity-type-create',
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    complete: function() {
                        $('.loading-spinner').css("display", "none");
                    },
                    success: function(res) {
                        $("#showTypeCreateModal").html(res.html);
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {
                        $('.loading-spinner').css("display", "none");
                    }
                }); //ajax
            });

            //celebrity type save
            $(document).on("click", "#createCelebrityType", function(e) {
                e.preventDefault();
                var formData = new FormData($('#celebrityTypeCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/celebrity/celebrity-type-store',
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
                        toastr.success('Artist Type Added successfully', res, options);
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


            //celebrity type edit
            $(document).on("click", "#typeEditBtn", function(e) {
                e.preventDefault();
                var id = $(this).attr("data-id");
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/celebrity/celebrity-type-edit',
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
                        $("#showTypeCreateModal").html(res.html);
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {
                        $('.loading-spinner').css("display", "none");
                    }
                }); //ajax
            });

            //celebrity type update
            $(document).on("click", "#updateCelebrityType", function(e) {
                e.preventDefault();
                var formData = new FormData($('#celebrityTypeUpdateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/celebrity/celebrity-type-update',
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
                        toastr.success('Artist Type updated successfully', res, options);
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

            //celebrity type create modal close
            $(document).on("click", ".cancel-type-create", function() {
                $('#typeCreateModal').modal().hide();
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
