@extends('frontend.layouts.client.index')
@section('content')
    <!-- video section start -->
    <section class="video margin-top-110 vidio-wrapper">
        <div class="container">
            <div class="vidio-banner">
                @if (!empty($request->type))
                    <h3 class="margin-top-20 all-video-title">{{ $request->type }}</h3>
                @endif
                @if (request('type') != 'history')
                    <div class="vidiobanner margin-top-20 margin-bottom-20">
                        <img src="{{ URL::to('/') }}/uploads/videoTopBanner.png" alt="">
                    </div>
                @endif
            </div>

        </div>
    </section>
    <!-- video section end -->
    <div class="container">
        <div class="row">
            @if (!$videos->isEmpty() && empty(request('type')))
                @foreach ($videos as $data)
                <?php
                $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                ?>
                    <div class="col-md-3 col-lg-2 col-sm-6 col-6 margin-bottom-30">
                        <div class="homepage-video-image">
                            <a href="/videoshow/{{ $data->id }}">
                                @if (!empty($data->thumbnail_vertical))
                                    <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $data->thumbnail_vertical }}"
                                        alt="{{ $data->title }}" title="{{ $data->title }}" class="{{ $parentalContent }}" />
                                @else
                                    <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" class="{{ $parentalContent }}" />
                                @endif
                                <div class="homepage-video-play-btn">
                                    <span class="iconify" data-icon="bi:play-circle-fill"></span>
                                </div>
                                {{-- preminum --}}
                                @if ($data->type == 'premium')
                                    <div class="premium-ribbon">Premium</div>
                                @endif
                            </a>
                        </div>
                        <div class="homepage-video-details">
                            <div class="title"><a href="/videoshow/{{ $data->id }}">{{ $data->title }}</a></div>
                            <div class="rating">
                                <i class="icofont icofont-star"></i>
                                {{ $data->tmdb_rating ? round($data?->tmdb_rating, 2) : 'n/a' }} TMDB
                            </div>
                            <div class="trailer">
                                <a href="">Watch Trailer</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif (!$videos->isEmpty() && !empty(request('type')))
                @foreach ($videos as $data)
                <?php
                $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                ?>
                    <div class="col-md-12 margin-top-20">

                        <a href="/videoshow/{{ $data->id }}">
                            <div class="row my-videos my-videos-{{ $data->id }} margin-bottom-10"
                                data-id="{{ $data->id }}">
                                <div class="col-md-3 col-sm-5 col-5 my-video-img">
                                    <div class="my-video-img-section">
                                        @if (!empty($data->thumbnail_vertical))
                                            <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $data->thumbnail_vertical }}"
                                                alt="{{ $data->title }}" title="{{ $data->title }}" class="{{ $parentalContent }}"/>
                                        @else
                                            <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" class="{{ $parentalContent }}" />
                                        @endif
                                        @if ($data->type == 'premium')
                                            <div class="premium-ribbon">Premium</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-7 col-7 my-video-details">
                                    <div class="my-video-title row">
                                        <div class="col-md-11 col-sm col-11">
                                            {{ $data->title }}
                                        </div>
                                        <div class="col-md-1 col-sm-1 col-1">
                                            {{-- <button class="clear-history-{{ $data->id }} clear-history-btn"
                                            data-id="{{ $data->id }}">
                                            <span class="iconify" data-icon="akar-icons:cross"></span>
                                        </button> --}}
                                        </div>
                                    </div>
                                    <div class="my-video-description">
                                        {{ $data->description }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @elseif ($videos->isEmpty() && request('type') == 'favourite')
                <div class="favorite-video-not-found text-center">
                    <div class="use-wink">
                        <img src="{{ URL::to('/') }}/uploads/wink.png" alt="wink" />
                    </div>
                    <div class="use-btn margin-top-20">Use &nbsp;<i class="far fa-heart"></i>&nbsp; Button</div>
                    <div class="use-des margin-top-20">to save your favorites</div>
                </div>
            @else
                <div class="video-not-found">No video found..!</div>
            @endif
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
        // add favorite
        $(document).on("change", ".video-id", function(e) {
            e.preventDefault();
            var id = $(this).val();
            var status = 'unchecked';
            if (this.checked == true) {
                status = 'checked';
            }

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'video/add-favorite',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    video_id: id,
                    status: status,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    toastr.success(res.message, res, options);
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

        // remove history
        $(document).on("click", ".clear-history-btn", function(e) {
            e.preventDefault();
            var id = $(this).data("id");

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'clear-history',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    video_id: id,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    toastr.success(res.message, res, options);
                    $('.my-videos-' + id).hide();
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


        $(document).on("mouseover", ".my-videos", function() {
            var id = $(this).data("id");
            var clearClass = 'clear-history-' + id;
            $('.' + clearClass).show();
        });
        $(document).on("mouseout", ".my-videos", function() {
            var id = $(this).data("id");
            var clearClass = 'clear-history-' + id;
            $('.' + clearClass).hide();
        });
    </script>
@endpush
