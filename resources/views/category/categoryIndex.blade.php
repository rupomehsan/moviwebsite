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
                            <a href="/admin/category" class="title-btn red" id="category">Category</a>
                        </span>
                        <div class="title-line category-title-line" id="categoryLine"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="sub-title">
                            <a href="/admin/category/sub-category-view" class="title-btn" id="subCategory">Sub Category</a>
                        </span>
                        <div class="title-line sub-category-title-line display-none"></div>
                    </div>
                    <div class="col-md-3">
                        <span class="sub-title">
                            <a href="/admin/category/tv-category-view" class="title-btn" id="tvCategory">Tv Channel
                                Category</a>
                        </span>
                        <div class="title-line tv-category-title-line display-none"></div>
                    </div>
                </div>

                <div class="row create-menus margin-top-20">
                    <div class="col-md-3">
                        <button type="button" class="" data-toggle="modal" data-target="#createModal"
                            id="categoryCreate">
                            <span class="iconify" data-icon="akar-icons:circle-plus-fill"></span>&nbsp; Add Category
                        </button>
                    </div>
                </div>
            </div>
            {{-- title --}}

            {{-- search --}}
            <div class="col-md-4 text-right">
                <form action="/admin/category/filter" method="POST" enctype="multipart/form-data">
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
                                        <button type="button" class="table-action-btn edit-action-btn" data-toggle="modal"
                                            data-target="#createModal" id="categoryEditBtn" data-id="{{ $data->id }}"
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





    {{-- Start::Create pannel --}}
    <div class="modal fade tabindex=" -1" role="dialog" aria-hidden="true" id="createModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal"></div>
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
                            url: window.origin + '/admin/category/destroy/Category',
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
                                } else if (jqXhr.status == 500) {
                                    toastr.error(jqXhr.responseJSON.message, '',
                                        options);
                                } else if (jqXhr.status == 401) {
                                    toastr.error('Sorry, You can not delete this item',
                                        'Authentication Error', options);
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

            //category create Modal
            $(document).on("click", "#categoryCreate", function(e) {
                e.preventDefault();
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/category/category-create',
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

            //category save
            $(document).on("click", "#createCategory", function(e) {
                e.preventDefault();
                var formData = new FormData($('#categoryCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/category/category-store',
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
                        toastr.success('Category Create successfully', res, options);
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

            //category edit Modal
            $(document).on("click", "#categoryEditBtn", function(e) {
                e.preventDefault();
                var id = $(this).attr("data-id");
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/category/edit',
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

            // category update
            $(document).on("click", "#editCategory", function(e) {
                e.preventDefault();
                var formData = new FormData($('#categoryEditForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/category/update',
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
                        toastr.success('Category updated successfully', res, options);
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

        });
    </script>
@endpush
