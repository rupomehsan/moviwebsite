@extends('frontend.layouts.client.index')
@section('content')
    <div class="header-gap"></div>

    @if (!empty($adsInfo))
        @foreach ($adsInfo as $ads)
            @if ($ads->ad_type == 'custom_header' && $ads->status == 'on' && $ads->image != null)
                <div class="container">
                    <div class="header-ad-section">
                        <a href="{{ $ads->ad_link }}" target="_blank">
                            <img src="{{ URL::to('/') }}/uploads/ad/{{ $ads->image }}" alt="Header ad image" />
                        </a>
                    </div>
                </div>
            @elseif($ads->ad_type == 'header' && $ads->status == 'on' && $ads->link != null)
                )
                <div class="container">
                    <div class="header-ad-section">
                        <a href="{{ $ads->ad_link }}" target="_blank">
                            <img src="{{ URL::to('/') }}/uploads/ad/{{ $ads->image }}" alt="Header ad image" />
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

    {{-- Start:: Top Trending Slider --}}
    @if (!$trendingVideoInfo->isEmpty())
        <div class="container">
            <div class="tranding-top-slider">

                <div class="owl-carousel trending-top-carousel owl-theme">

                    @foreach ($trendingVideoInfo as $data)
                        <div class="card item trending-top-slider  margin-top-20">
                            <a href="/videoshow/{{ $data->id }}">
                                <div class="trending-container">
                                    <div class="pannel-heading">
                                        <div class="pannel-name">
                                            Trending Now
                                            <div class="triangle"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-12">
                                            <div class="video-title margin-top-54">
                                                <div class="title">
                                                    <div class="prev-line"></div>
                                                    <div class="title-text">{{ $data->title }}</div>
                                                </div>
                                                <div class="video-details margin-top-10">
                                                    <div class="details-line tmdb">
                                                        <i class="icofont icofont-star"></i>
                                                        {{ $data->tmdb_rating ? round($data?->tmdb_rating, 2) : 'n/a' }}
                                                        TMDB
                                                    </div>
                                                    <div class="details-line middle-line"></div>
                                                    <div class="details-line duration">
                                                        {{ $data->duration_hour ? $data->duration_hour . ' Hr' : '' }}
                                                        {{ $data->duration ? $data->duration . ' Min' : '' }}
                                                        {{ $data->duration_sec ? $data->duration_sec . ' Sec' : '' }}
                                                    </div>
                                                    <div class="details-line middle-line"></div>
                                                    <div class="details-line trailer">

                                                        <a href="#" class="watch-trailer-btn {!! !empty($data->trailer) ? '' : 'no-trailer-avilable' !!}"
                                                            data-id="{{ $data->trailer }}" data-toggle="modal"
                                                            data-target="#renderTrailerModal">
                                                            Watch Trailer
                                                        </a>
                                                    </div>

                                                    <div class="description margin-top-14">
                                                        {{ $data->description ?? '' }}
                                                    </div>

                                                    @if (!empty($genreArr))
                                                        <div class="grnres-container">
                                                            @if (!empty($genreArr[$data->id]))
                                                                @foreach ($genreArr[$data->id] as $id => $name)
                                                                    <div class="single-genre">
                                                                        <a
                                                                            href="{{ url('/video?type=genre&genre_id=' . $id) }}">
                                                                            {{ $name }}
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>


                                                @if (!empty($celibritiesArr))
                                                    <div class="video-casts margin-top-20">
                                                        <h4>CAST & CREW</h4>

                                                        <div class="casts">

                                                            @if (!$celibritiesArr[$data->id]->isEmpty())
                                                                <?php $count = '1'; ?>
                                                                @foreach ($celibritiesArr[$data->id] as $celebrity)
                                                                    <div class="single-cast">
                                                                        @if ($celebrity->file_type == 'link')
                                                                            <img src="{{ $celebrity->file_link }}"
                                                                                alt="{{ $celebrity->name }}"
                                                                                title="{{ $celebrity->name }}" />
                                                                        @else
                                                                            @if (!empty($celebrity->image))
                                                                                <img src="{{ URL::to('/') }}/uploads/celebrity/{{ $celebrity->image }}"
                                                                                    alt="{{ $celebrity->name }}"
                                                                                    title="{{ $celebrity->name }}" />
                                                                            @else
                                                                                <img
                                                                                    src="{{ URL::to('/') }}/uploads/no.jpeg" />
                                                                            @endif
                                                                        @endif
                                                                        <div class="cast-name">{{ $celebrity->name }}</div>
                                                                    </div>

                                                                    <?php
                                                                    if ($count === '3') {
                                                                        break;
                                                                    }
                                                                    $count++;
                                                                    ?>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <?php
                                            $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                                            ?>
                                            <div class="video-thumbnail">
                                                @if (!empty($data->thumbnail_vertical))
                                                    <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $data->thumbnail_vertical }}"
                                                        alt="{{ $data->title }}" title="{{ $data->title }}"
                                                        class="{{ $parentalContent }}" />
                                                @else
                                                    <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt=""
                                                        class="{{ $parentalContent }}" />
                                                @endif


                                                {{-- favorite btn --}}
                                                @if (!empty(Auth()->id()))
                                                    <?php
                                                    $checked = '';
                                                    if (in_array($data->id, $favoriteList)) {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                                    <div class="text-right">
                                                        <input type="checkbox" class="video-id" name="video_id"
                                                            value="{{ $data->id }}" {{ $checked }}>
                                                    </div>
                                                @endif
                                                {{-- end favorite btn --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    @else
        <div class="margin-top-20"></div>
    @endif
    {{-- End:: Top Trending Slider --}}

    {{-- just added --}}
    @if (!$justAdded->isEmpty())
        <div class="container margin-top-10">

            <div class="homepage-video-pannel-title">
                <div class="title">
                    Just Added
                    <div class="triangle-container">
                        <div class="triangle"></div>
                    </div>
                </div>
            </div>

            <!--Slides-->
            <div class="owl-carousel just-added-carousel owl-theme">
                @foreach ($justAdded as $data)
                    <?php
                    $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                    ?>
                    <div class="card item homepage-video-slider  margin-top-20">
                        <div class="homepage-video-image">
                            <a href="/videoshow/{{ $data->id }}">
                                @if (!empty($data->thumbnail))
                                    <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $data->thumbnail }}"
                                        alt="{{ $data->title }}" title="{{ $data->title }}"
                                        class="{{ $parentalContent }}" />
                                @else
                                    <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt=""
                                        class="{{ $parentalContent }}" />
                                @endif
                                <div class="homepage-video-play-btn">
                                    <span class="iconify" data-icon="bi:play-circle-fill"></span>
                                </div>
                                {{-- preminum --}}
                                @if ($data->type == 'premium')
                                    <div class="premium-ribbon">Premium</div>
                                @endif

                                {{-- favorite btn --}}
                                @if (!empty(Auth()->id()))
                                    <?php
                                    $checked = '';
                                    if (in_array($data->id, $favoriteList)) {
                                        $checked = 'checked';
                                    }
                                    ?>
                                    <div class="text-right">
                                        <input type="checkbox" class="video-id" name="video_id" value="{{ $data->id }}"
                                            {{ $checked }}>
                                    </div>
                                @endif
                                {{-- end favorite btn --}}
                            </a>
                        </div>
                        <div class="homepage-video-details">
                            <div class="title"><a href="/videoshow/{{ $data->id }}">{{ $data->title }}</a></div>
                            <div class="rating">
                                <i class="icofont icofont-star"></i>
                                {{ $data->tmdb_rating ? round($data?->tmdb_rating, 2) : 'n/a' }} TMDB
                            </div>
                            <div class="trailer">
                                <a href="#" class="watch-trailer-btn {!! !empty($data->trailer) ? '' : 'no-trailer-avilable' !!}" data-id="{{ $data->trailer }}"
                                    data-toggle="modal" data-target="#renderTrailerModal">
                                    Watch Trailer
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <!--/.Slides-->
        </div>
    @endif
    {{-- just added --}}

    <!-- popular video section start -->
    <section class="video margin-top-40">
        <div class="container">
            <div class="pupular">

                <div class="homepage-video-pannel-title">
                    <div class="title">
                        Popular
                        <div class="triangle-container">
                            <div class="triangle"></div>
                        </div>
                    </div>
                </div>



                <!--Slides-->
                <div class="owl-carousel popular-carousel owl-theme">
                    @foreach ($populerVideoInfo as $data)
                        <?php
                        $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                        ?>
                        <div class="card item popular-slider  margin-top-20">

                            <div class="popupar-wrapper">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-lg-4 col-sm-6 col-12">
                                        <div class="homepage-video-image">
                                            <a href="/videoshow/{{ $data->id }}">
                                                @if (!empty($data->thumbnail_vertical))
                                                    <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $data->thumbnail_vertical }}"
                                                        alt="{{ $data->title }}" title="{{ $data->title }}"
                                                        class="popular-thumbnail {{ $parentalContent }}" />
                                                @else
                                                    <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt=""
                                                        class="{{ $parentalContent }}" />
                                                @endif
                                                <div class="homepage-video-play-btn">
                                                    <span class="iconify" data-icon="bi:play-circle-fill"></span>
                                                </div>
                                                {{-- preminum --}}
                                                @if ($data->type == 'premium')
                                                    <div class="premium-ribbon">Premium</div>
                                                @endif

                                                {{-- favorite btn --}}
                                                @if (!empty(Auth()->id()))
                                                    <?php
                                                    $checked = '';
                                                    if (in_array($data->id, $favoriteList)) {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                                    <div class="text-right">
                                                        <input type="checkbox" class="video-id" name="video_id"
                                                            value="{{ $data->id }}" {{ $checked }}>
                                                    </div>
                                                @endif
                                                {{-- end favorite btn --}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-8 col-sm-6 col-12">
                                        <div class="row">
                                            <div class="prpular-right text-left">
                                                <h4 class="ptb-20">{{ $data->short_title }}</h4>
                                                <p class="card-text">
                                                    {{ $data->description }}
                                                </p> <br>

                                                {{-- favorite btn --}}
                                                @if (!empty(Auth()->id()))
                                                    <?php
                                                    $checked = '';
                                                    if (in_array($data->id, $favoriteList)) {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                                    <span class="text-right populer-checkbox">
                                                        <input type="checkbox" class="video-id" id="videoId"
                                                            name="video_id" value="{{ $data->id }}"
                                                            {{ $checked }}>
                                                        <label for="videoId">Add To Favourite</label>
                                                    </span>
                                                @endif
                                                {{-- end favorite btn --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                <!--/.Slides-->
            </div>
        </div>
    </section>
    <!-- popular video section end -->

    {{-- subCategory video content --}}
    @if (!empty($subCategoryShow))
        <?php $subCategorySerial = '1'; ?>
        @foreach ($subCategoryShow as $id => $name)
            <div class="container margin-top-20">


                <div class="homepage-video-pannel-title">
                    <div class="title">
                        {{ $name }}
                        <div class="triangle-container">
                            <div class="triangle"></div>
                        </div>
                    </div>
                </div>

                <!--Slides-->
                <div class="owl-carousel just-added-carousel owl-theme">
                    @foreach ($subCategoryVideoInfo as $data)
                        <?php
                        $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                        ?>
                        @if ($data->sub_category_id == $id)
                            <div class="card item homepage-video-slider  margin-top-20">
                                <div class="homepage-video-image">
                                    <a href="/videoshow/{{ $data->id }}">
                                        @if (!empty($data->thumbnail))
                                            <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $data->thumbnail }}"
                                                alt="{{ $data->title }}" title="{{ $data->title }}"
                                                class="{{ $parentalContent }}" />
                                        @else
                                            <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt=""
                                                class="{{ $parentalContent }}" />
                                        @endif
                                        <div class="homepage-video-play-btn">
                                            <span class="iconify" data-icon="bi:play-circle-fill"></span>
                                        </div>
                                        {{-- preminum --}}
                                        @if ($data->type == 'premium')
                                            <div class="premium-ribbon">Premium</div>
                                        @endif

                                        {{-- favorite btn --}}
                                        @if (!empty(Auth()->id()))
                                            <?php
                                            $checked = '';
                                            if (in_array($data->id, $favoriteList)) {
                                                $checked = 'checked';
                                            }
                                            ?>
                                            <div class="text-right">
                                                <input type="checkbox" class="video-id" name="video_id"
                                                    value="{{ $data->id }}" {{ $checked }}>
                                            </div>
                                        @endif
                                        {{-- end favorite btn --}}
                                    </a>
                                </div>
                                <div class="homepage-video-details">
                                    <div class="title"><a href="/videoshow/{{ $data->id }}">{{ $data->title }}</a>
                                    </div>
                                    <div class="rating">
                                        <i class="icofont icofont-star"></i>
                                        {{ $data->tmdb_rating ? round($data?->tmdb_rating, 2) : 'n/a' }} TMDB
                                    </div>
                                    <div class="trailer">
                                        <a href="#" class="watch-trailer-btn {!! !empty($data->trailer) ? '' : 'no-trailer-avilable' !!}" data-id="{{ $data->trailer }}"
                                            data-toggle="modal" data-target="#renderTrailerModal">
                                            Watch Trailer
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endif
                    @endforeach
                </div>
                <!--/.Slides-->
            </div>
            <?php $subCategorySerial++; ?>
        @endforeach
    @endif
    {{-- subCategory video content --}}

    {{-- Render Trailer Modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="renderTrailerModal">
        <div class="modal-dialog modal-lg">
            <div id="renderTrailerContent"></div>
        </div>
    </div>

@endsection

@push('custom-js')
    <script>
        $('.trending-top-carousel').owlCarousel({
            items: 1,
            loop: false,
            autoplay: true,
            responsiveClass: true,
            margin: 10,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"]
        });

        $('.just-added-carousel').owlCarousel({
            items: 7,
            loop: true,
            autoplay: true,
            responsiveClass: true,
            margin: 10,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 7
                }
            }
        });

        $('.popular-carousel').owlCarousel({
            items: 1,
            loop: false,
            autoplay: true,
            responsiveClass: true,
            margin: 10,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"]
        });


        $('.sponsor-carousel').owlCarousel({
            items: 2,
            loop: true,
            autoplay: true,
            responsiveClass: true,
            margin: 20,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        });


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
                url: window.origin + '/video/add-favorite',
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

        // play trailer
        $(document).on("click", ".watch-trailer-btn", function(e) {
            e.preventDefault();

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };

            var trailer = $(this).attr("data-id");


            if (trailer == '' || trailer == null) {
                toastr.error('No Trailer link', options);
                return false;
            }
            // alert(trailer);

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/watch-trailer',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    trailer: trailer,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#renderTrailerContent").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            });
        });
    </script>
@endpush
