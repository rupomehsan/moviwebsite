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
            <div class="col-md-8 content-title">
                <div class="content-title-body">
                    <span class="title">Country</span>
                    <div class="title-line"></div>
                </div>
                <input type="checkbox" name="pannel-status" data-id="country" class="switch" id="pannelStatus"
                    {{ $checked }}>

                <!-- Button trigger modal -->
            </div>
            {{-- title --}}

            {{-- search --}}
            <div class="col-md-4 text-right pannel-status {{ $class }}">
                <form action="/admin/country/filter" method="POST" enctype="multipart/form-data">
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

        <div class="margin-top-20 action-buttons">
            <button type="button" class="single-action pannel-status {{ $class }}" data-toggle="modal"
                data-target="#crateModal" id="crateBtn">
                <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Add Country
            </button>
        </div>

    </div>
    {{-- End:: content heading --}}
    {{-- <div class="onoffswitch">
        <input type="checkbox" class="onoffswitch-checkbox" data-id="country" id="pannelStatus" tabindex="0"
            {{ $checked }}>
        <label class="onoffswitch-label" for="pannelStatus">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
        </label>
    </div> --}}

    {{-- Start::Content Body --}}
    <div class="pannel-status {{ $class }}">
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
        <div class="row country-details">
            {{-- country --}}
            @if (!$target->isEmpty())
                @foreach ($target as $data)
                    <div class="col-md-2 col-sm-3 col-6 margin-top-20">
                        <div class="country-image text-center">
                            @if ($data->file_type == 'link')
                                <img src="{{ $data->file_link }}" alt="{{ $data->name }}" title="{{ $data->name }}" />
                            @else
                                @if (!empty($data->image))
                                    <img src="{{ URL::to('/') }}/uploads/country/{{ $data->image }}"
                                        alt="{{ $data->name }}" title="{{ $data->name }}" />
                                @else
                                    <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                                @endif
                            @endif
                        </div>
                        <div class="country-name margin-top-10 text-center">
                            <span class="bold">{{ $data->name }}</span>
                        </div>
                        {{-- <div class="country-action text-center margin-top-10">
                            <button title="Edit" type="button" data-toggle="modal" data-target="#crateModal" id="editBtn"
                                data-id="{{ $data->id }}">
                                <span class="iconify" data-icon="ant-design:edit-filled"></span>
                            </button>&nbsp;&nbsp;

                            <button type="button" id="deleteItem" data-id={{ $data->id }} title="Delete">
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
                                    data-target="#crateModal" id="editBtn" data-id="{{ $data->id }}"><span
                                        class="iconify" data-icon="ant-design:edit-filled"></span> Edit
                                    Country</button>
                                <button type="button" class="popup-action-button" id="deleteItem"
                                    data-id={{ $data->id }} title="Delete">
                                    <span class="iconify" data-icon="ant-design:delete-filled"></span> Delete Country
                                </button>
                            </div>
                        </div>

                        </span>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
    {{-- End::Content Body --}}
    <div class="off-text-content {{ $offText }}"> This function are currentlly off..!</div>

    {{-- create modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="crateModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal">

            </div>
        </div>
    </div>


@stop
@push('custom-js')
    <script type="text/javascript">
        $(function() {
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
                // alert(name);

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
                    url: window.origin + '/admin/country/create',
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
                            url: window.origin + '/admin/country/destroy',
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

            // edit Modal
            $(document).on("click", "#editBtn", function(e) {
                e.preventDefault();
                var id = $(this).attr("data-id");
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/country/edit',
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
            $(document).on("click", "#createCountry", function(e) {
                e.preventDefault();
                var formData = new FormData($('#countryCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/country/store',
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
                        toastr.success('Country Added successfully', res, options);
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
            $(document).on("click", "#editCountry", function(e) {
                e.preventDefault();
                var formData = new FormData($('#countryEditForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/country/update',
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
                        toastr.success('Country updated successfully', res, options);
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
