@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Subscriber</span>
                <div class="title-line"></div>
            </div>
            {{-- title --}}

        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}
    <div class="row margin-top-40 content-details">
        <div style="overflow-x:auto;">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center">SERIAL</th>
                        <th scope="col" class="text-center">EMAIL</th>
                        <th scope="col" class="text-center">SUBSCRIBED ON</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl = 1; ?>
                    @if (!$target->isEmpty())
                        @foreach ($target as $data)
                            <tr>
                                <th class="text-center" scope="row">{{ $sl++ }}</th>
                                <td class="text-center">{{ $data->email }}</td>
                                <td class="text-center">{{ $data->added_on }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </div>
    {{-- End::Content Body --}}


@stop
@push('custom-js')
    <script type="text/javascript">
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
                        url: window.origin + '/admin/destroy',
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
    </script>
@endpush
