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
                    <span class="title">Genres</span>
                    <div class="title-line"></div>
                </div>
                <input type="checkbox" name="pannel-status" data-id="genres" class="switch" id="pannelStatus"
                    {{ $checked }}>
            </div>
            {{-- title --}}

            {{-- search --}}
            <div class="col-md-4 text-right pannel-status {{ $class }}">
                <form action="/admin/genres/filter" method="POST" enctype="multipart/form-data">
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
                <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Add Genres
            </button>
        </div>
    </div>
    {{-- End:: content heading --}}

    <div class="pannel-status {{ $class }}">
        {{-- Start:: Table Content --}}
        <?php
    $ses_msg = Session::has('success');
    if (!empty($ses_msg)) {
        ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('success'); ?></p>
        </div>
        <?php
    }
    $ses_msg = Session::has('error');
    if (!empty($ses_msg)) {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('error'); ?></p>
        </div>
        <?php
    } ?>
        <div class="main-content-body" id="mainContentBody">
            <div class="pannel-table-content margin-top-40">
                <div class="table-wrapper">
                    <table style="min-width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center">Serial</th>
                                <th>Name</th>
                                <th class="text-center">Total Videos</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl = 1; ?>
                            @if (!$target->isEmpty())
                                @foreach ($target as $data)
                                    <tr>
                                        <td class="text-center">{{ $sl++ }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td class="text-center">{{ $numberVideo[$data->id] ?? '0' }}</td>
                                        <td class="text-center">
                                            <button type="button" class="table-action-btn edit-action-btn"
                                                data-toggle="modal" data-target="#crateModal" id="editBtn"
                                                data-id="{{ $data->id }}
                                            title="Edit">
                                                <span class="iconify" data-icon="bx:edit-alt"></span>
                                                Edit
                                            </button>
                                            <button type="button" class="table-action-btn delete-action-btn" title="Delete"
                                                id="deleteItem" data-id={{ $data->id }}>
                                                <span class="iconify" data-icon="ant-design:delete-outlined"></span>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                    </table>
                </div>
            </div>
        </div>
        {{-- End:: Table Content --}}
        <div class="off-text-content {{ $offText }}"> This function are currentlly off..!</div>





        {{-- Start::Create pannel --}}
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="crateModal">
            <div class="modal-dialog modal-lg">
                <div id="showCreateModal">

                </div>
            </div>
        </div>
        {{-- End::Create pannel --}}


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
                                url: window.origin + '/admin/genres/destroy',
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
                        url: window.origin + '/admin/genres/create',
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

                // create Modal
                $(document).on("click", "#editBtn", function(e) {
                    e.preventDefault();
                    var id = $(this).attr("data-id");
                    $('.loading-spinner').css("display", "flex");
                    $.ajax({
                        url: window.origin + '/admin/genres/edit',
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
                $(document).on("click", "#createGenre", function(e) {
                    e.preventDefault();
                    var formData = new FormData($('#genreCreateForm')[0]);

                    var options = {
                        closeButton: true,
                        debug: false,
                        positionClass: "toast-bottom-right",
                        onclick: null
                    };
                    $('.loading-spinner').css("display", "flex");
                    $.ajax({
                        url: window.origin + '/admin/genres/store',
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
                            toastr.success('Genres Added successfully', res, options);
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
                $(document).on("click", "#editGenres", function(e) {
                    e.preventDefault();
                    var formData = new FormData($('#genresEditForm')[0]);

                    var options = {
                        closeButton: true,
                        debug: false,
                        positionClass: "toast-bottom-right",
                        onclick: null
                    };
                    $('.loading-spinner').css("display", "flex");
                    $.ajax({
                        url: window.origin + '/admin/genres/update',
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
                            toastr.success('Genres updated successfully', res, options);
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
            });
        </script>
    @endpush
