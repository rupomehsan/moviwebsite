@extends('frontend.layouts.client.index')
@section('content')
    <!-- video section start -->
    <section class="video ptb-90">
        <div class="container">

            <div class="category ptb-30">
                <div class="header-add-section ads-section category-top-header-section margin-top-40 row">
                    <div class="text-right">
                        <img src="{{ URL::to('/') }}/uploads/videoTopBanner.png" alt="">
                    </div>
                </div>


                {{-- Start::category --}}
                @if (!$categoryInfo->isEmpty())
                    <div class="single-section margin-top-40">
                        <div class="heding">
                            <h3>Category</h3>
                            {{-- <a class="" data-toggle="collapse" href="#collapseExample6" role="button"
                                aria-expanded="false" aria-controls="collapseExample6">
                                View All
                            </a> --}}
                        </div>

                        <!--Slides-->
                        <div class="owl-carousel country-carousel owl-theme" id="owlCarousel6">
                            @foreach ($categoryInfo as $category)
                                <div class="card item margin-top-40">
                                    <a href="{{ url('/category-index?category_id=' . $category->id) }}">
                                        <div class="country-slider-new">
                                            <div class="img">
                                                @if ($category->file_type == 'link')
                                                    <img src="{{ $category->file_link }}" alt="{{ $category->name }}"
                                                        title="{{ $category->name }}" />
                                                @else
                                                    @if (!empty($category->image))
                                                        <img src="{{ URL::to('/') }}/uploads/category/{{ $category->image }}"
                                                            alt="{{ $category->name }}" title="{{ $category->name }}" />
                                                    @else
                                                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="name margin-top-10">{{ $category->name }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="collapse" id="collapseExample6">
                            <div class="">
                                @foreach ($categoryInfo as $category)
                                    <div class="heading-img">
                                        <a href="{{ url('/category-index?category_id=' . $category->id) }}">
                                            <div class="country-slider-new">
                                                <div class="img">
                                                    @if (!empty($category->image))
                                                        <img src="{{ URL::to('/') }}/uploads/category/{{ $category->image }}"
                                                            alt="{{ $category->name }}" title="{{ $category->name }}" />
                                                    @else
                                                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                                                    @endif
                                                </div>
                                                <div class="name margin-top-10">{{ $category->name }}</div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--/.Slides-->
                    </div>
                @endif
                {{-- End::Country --}}

                {{-- Start::Country --}}
                @if (!$countryInfo->isEmpty())
                    <div class="single-section margin-top-40">
                        <div class="heding">
                            <h3>Country</h3>
                            {{-- <a class="" data-toggle="collapse" href="#collapseExample" role="button"
                                aria-expanded="false" aria-controls="collapseExample">
                                View All
                            </a> --}}
                        </div>

                        <!--Slides-->
                        <div class="owl-carousel country-carousel owl-theme" id="owlCarousel">
                            @foreach ($countryInfo as $country)
                                <div class="card item margin-top-40">
                                    <a href="{{ url('/video?type=country&country_id=' . $country->id) }}">
                                        <div class="country-slider-new">
                                            <div class="img">
                                                @if ($country->file_type == 'link')
                                                    <img src="{{ $country->file_link }}" alt="{{ $country->name }}"
                                                        title="{{ $country->name }}" />
                                                @else
                                                    @if (!empty($country->image))
                                                        <img src="{{ URL::to('/') }}/uploads/country/{{ $country->image }}"
                                                            alt="{{ $country->name }}" title="{{ $country->name }}" />
                                                    @else
                                                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="name margin-top-10">{{ $country->name }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="collapse" id="collapseExample">
                            <div class="">
                                @foreach ($countryInfo as $country)
                                    <div class="heading-img">
                                        <a href="{{ url('/video?type=country&country_id=' . $country->id) }}">
                                            <div class="country-slider-new">
                                                <div class="img">
                                                    @if (!empty($country->image))
                                                        <img src="{{ URL::to('/') }}/uploads/country/{{ $country->image }}"
                                                            alt="{{ $country->name }}" title="{{ $country->name }}" />
                                                    @else
                                                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                                                    @endif
                                                </div>
                                                <div class="name margin-top-10">{{ $country->name }}</div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--/.Slides-->
                    </div>
                @endif
                {{-- End::Country --}}

                {{-- Start::Year --}}
                @if (!$years->isEmpty())
                    <div class="single-section">
                        <div class="heding">
                            <h3>Year</h3>
                        </div>

                        <div class="owl-carousel country-carousel owl-theme" id="owlCarousel">
                            @foreach ($years as $index => $year)
                                <div class="card item margin-top-40 year-carousel">
                                    <a href="{{ url('/video?type=year&year=' . $year->year) }}">
                                        <img src="{{ asset('assets/img/year.png') }}" alt="">
                                        <div class="name text-center margin-top-10">{{ $year->year }}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                {{-- End::Year --}}

                {{-- Start:: Celebrities --}}
                @if (!$celebrityInfo->isEmpty())
                    <div class="single-section">
                        <div class="heding">
                            <h3>Celebrity</h3>
                            {{-- <a class="" data-toggle="collapse" href="#collapseExample3" role="button"
                                aria-expanded="false" aria-controls="collapseExample">
                                View All
                            </a> --}}
                        </div>


                        <!--Slides-->
                        <div class="owl-carousel country-carousel owl-theme" id="owlCarousel3">
                            @foreach ($celebrityInfo as $celebrity)
                                <div class="card item margin-top-40">
                                    <a href="{{ url('/video?type=celebrity&celebrity_id=' . $celebrity->id) }}">
                                        <div class="country-slider">
                                            <div class="img">
                                                @if ($celebrity->file_type == 'link')
                                                    <img src="{{ $celebrity->file_link }}" alt="{{ $celebrity->name }}"
                                                        title="{{ $celebrity->name }}" />
                                                @else
                                                    @if (!empty($celebrity->image))
                                                        <img src="{{ URL::to('/') }}/uploads/celebrity/{{ $celebrity->image }}"
                                                            alt="{{ $celebrity->name }}" title="{{ $celebrity->name }}" />
                                                    @else
                                                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="name margin-top-10">{{ $celebrity->name }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="collapse" id="collapseExample3">
                            <div class="">
                                @foreach ($celebrityInfo as $celebrity)
                                    <div class="heading-img">
                                        <a href="{{ url('/video?type=celebrity&celebrity_id=' . $celebrity->id) }}">
                                            <div class="country-slider">
                                                <div class="img">
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
                                                            <img src="{{ URL::to('/') }}/uploads/no.jpeg"
                                                                alt="" />
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="name margin-top-10">{{ $celebrity->name }}</div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--/.Slides-->
                    </div>
                @endif
                {{-- End:: Celebrities --}}

                {{-- Start:: Genre --}}
                {{-- @if (!$genreInfo->isEmpty())
                    <div class="single-section margin-top-40">
                        <div class="heding">
                            <h3 class="mb-50">Genres</h3>
                        </div>

                        <div class="owl-carousel genre-carousel owl-theme">
                            @foreach ($genreInfo as $genre)
                                <div class="card item margin-top-40">
                                    <a href="{{ url('/video?type=genre&genre_id=' . $genre->id) }}">
                                        <div class="genre-carousel-name margin-top-10">{{ $genre->name }}</div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif --}}
                {{-- End:: Genre --}}

                {{-- Start:: Live Tv --}}
                @if (!$tvInfo->isEmpty())
                    <div class="single-section">
                        <div class="heding">
                            <h3>Live TV</h3>
                        </div>


                        <!--Slides-->
                        <div class="owl-carousel country-carousel owl-theme" id="owlCarousel4">
                            @foreach ($tvInfo as $tv)
                                <div class="card item margin-top-40">
                                    <a href="{{ url('/live-tv/' . $tv->id) }}">
                                        <div class="country-slider-new">
                                            <div class="img">
                                                @if ($tv->file_type == 'link')
                                                    <img src="{{ $tv->file_link }}" alt="{{ $tv->name }}"
                                                        title="{{ $tv->name }}" />
                                                @else
                                                    @if (!empty($tv->image))
                                                        <img src="{{ URL::to('/') }}/uploads/tv/{{ $tv->image }}"
                                                            alt="{{ $tv->name }}" title="{{ $tv->name }}" />
                                                    @else
                                                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="name margin-top-10">{{ $tv->name }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        {{-- <div class="collapse" id="collapseExample4">
                            <div class="">
                                @foreach ($tvInfo as $tv)
                                    <div class="heading-img">
                                        <a
                                            href="{{ url('/video?type=celebrity&celebrity_id=' . $tv->id) }}">
                                            <div class="country-slider-new">
                                                <div class="img">
                                                    @if (!empty($tv->image))
                                                        <img src="{{ URL::to('/') }}/uploads/tv/{{ $tv->image }}"
                                                            alt="{{ $tv->name }}"
                                                            title="{{ $tv->name }}" />
                                                    @else
                                                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                                                    @endif
                                                </div>
                                                <div class="name margin-top-10">{{ $tv->name }}</div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}
                        <!--/.Slides-->
                    </div>
                @endif
            </div>


        </div>



        </div>
    </section><!-- video section end -->


@endsection
@push('custom-js')
    <script>
        $('.country-carousel').owlCarousel({
            items: 8,
            loop: true,
            autoplay: true,
            responsiveClass: true,
            margin: 20,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 6
                },
                1000: {
                    items: 8
                }
            }
        });

        $('.genre-carousel').owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            responsiveClass: true,
            margin: 20,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

        $('#collapseExample').on('shown.bs.collapse', function() {
            $("#owlCarousel").addClass("display-none");
        });
        $('#collapseExample').on('hidden.bs.collapse', function() {
            $("#owlCarousel").removeClass("display-none");
        });

        $('#collapseExample3').on('shown.bs.collapse', function() {
            $("#owlCarousel3").addClass("display-none");
        });
        $('#collapseExample3').on('hidden.bs.collapse', function() {
            $("#owlCarousel3").removeClass("display-none");
        });


        $('#collapseExample6').on('shown.bs.collapse', function() {
            $("#owlCarousel6").addClass("display-none");
        });
        $('#collapseExample6').on('hidden.bs.collapse', function() {
            $("#owlCarousel6").removeClass("display-none");
        });
    </script>
@endpush
