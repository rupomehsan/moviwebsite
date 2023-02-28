@extends('layouts.default.master')
@section('data_count')
    {{-- Titles --}}
    {{-- <a href="{{url('/send-notification')}}">Send Notification</a> --}}
    <!-- <img src="{{ asset('img/Hello.png') }}" alt="Hello"> -->
    <h4 class="margin-top-20">
        <span class="bold">Welcome</span> <span class="bold red">Onboard</span>
    </h4>
    <div class=" margin-top-20">
        <span class="red">User Overview</span>
        <div class="line margin-top-10"></div>
    </div>
    {{-- Titles --}}

    <div class="row">
        <div class="col-md-7 col-sm-12 col-12 margin-top-20">
            {{-- Start:: Menu Carts --}}
            <div class="menu-carts">
                <div class="row">
                    {{-- single cart --}}

                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="/admin/category">
                            <div class="cart">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4 class="bold">{{ $totalCategory ?? '0' }}</h4>
                                        <span class="cart-title">Category</span>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="iconify" data-icon="ic:outline-category"></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="/admin/video">
                            <div class="cart">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4 class="bold">{{ $totalVideo ?? '0' }}</h4>
                                        <span class="cart-title">Total Video</span>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="iconify" data-icon="ic:baseline-video-library"></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="/admin/user">
                            <div class="cart">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4 class="bold">{{ $totalUser ?? '0' }}</h4>
                                        <span class="cart-title">Total User</span>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="iconify" data-icon="ph:users-four"></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="cart">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="bold">{{ $totalVideoView ?? '0' }}</h4>
                                    <span class="cart-title">Total View</span>
                                </div>
                                <div class="col-md-3">
                                    <span class="iconify" data-icon="ant-design:eye-filled"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End:: Menu Carts --}}

            {{-- Start:: Unread Carts --}}
            <div class="unread-carts margin-top-10">
                <div class="row">

                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="unread-cart">
                            <div class="row">
                                <a href="/admin/report" style="padding:0;">
                                    <div class="text-center" style="padding:0;">
                                        <span class="unread-title">Unread Report</span>
                                        <p class="unread-number background-red">{{ $unreadReport ?? '0' }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- End:: Unread Carts --}}
        </div>
        <div class="col-md-5 col-sm-12 col-12 margin-top-20">
            {{-- Start::Right Top Cart --}}
            <div class="right-cart">
                <div class="right-cart-top">
                    <div class="row">
                        <div class="col-md-9 col-sm-7 cl-6">
                            <ul class="">
                                <li class="right-cart-top-day right-cart-top-active">
                                    <button class="right-day-button" type="button">Last Day</button>
                                </li>
                                <li class="right-cart-top-week">
                                    <button class="right-week-button" type="button">Last Week</button>
                                </li>
                                {{-- <li class="right-cart-top-month">
                                <button class="right-month-button" type="button">Last Month</button>
                            </li> --}}
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-5 cl-6">
                            <select name="" id="cartYearSelect" class="">
                                @if (!empty($dateList))
                                    @foreach ($dateList as $value => $data)
                                        <option value="{{ $value }}">{{ $data }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>



                </div>
                <div class="right-cart-body">
                    <div class="row">
                        <div class="col-md-3 border-left-purple">
                            <h5 class="bold day-view">{{ $lastDayVideoView ?? '0' }}</h5>
                            <h5 class="bold week-view display-none">{{ $lastWeekVideoView ?? '0' }}</h5>
                            <h5 class="bold month-view display-none">{{ $lastMonthVideoView ?? '0' }}</h5>
                            <h5 class="bold yearly-view display-none yearly-video"></h5>
                            <span class="cart-title">Total View</span>
                        </div>
                        <div class="col-md-3 border-left-green">
                            <h5 class="bold day-view">{{ $lastDayComment ?? '0' }}</h5>
                            <h5 class="bold week-view display-none">{{ $lastWeekComment ?? '0' }}</h5>
                            <h5 class="bold month-view display-none">{{ $lastMonthComment ?? '0' }}</h5>
                            <h5 class="bold yearly-view display-none yearly-comment"></h5>
                            <span class="cart-title">Total Comment</span>
                        </div>
                        <div class="col-md-3 border-left-orange">
                            <h5 class="bold day-view">{{ $lastDayReport ?? '0' }}</h5>
                            <h5 class="bold week-view display-none">{{ $lastWeekReport ?? '0' }}</h5>
                            <h5 class="bold month-view display-none">{{ $lastMonthReport ?? '0' }}</h5>
                            <h5 class="bold yearly-view display-none yearly-report"></h5>
                            <span class="cart-title">Total Report</span>
                        </div>
                        {{-- <div class="col-md-3 border-left-red">
                            <h5 class="bold">725,896</h5>
                            <span class="cart-title">Dummy</span>
                        </div> --}}
                    </div>
                </div>
            </div>
            {{-- End::Right Top Cart --}}

            {{-- Start:: Top Category Cart --}}
            <div class="top-category-cart margin-top-20">
                <span class="category-cart-title bold">Top Categories</span>
                <div class="title-line"></div>
                <div class="row">
                    @if (!$categoryList->isEmpty())
                        @foreach ($categoryList as $category)
                            <div class="col-md-4 margin-top-20">
                                <div class="category-cart-content ">
                                    <div class="row ">
                                        <div class="col-md-4 category-cart-content-icon">

                                            @if (!empty($category->image))
                                                <img src="{{ URL::to('/') }}/uploads/category/{{ $category->image }}"
                                                    alt="{{ $category->name }}" title="{{ $category->name }}" />
                                            @else
                                                <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="text-center">
                                                <span class="category-cart-content-title">{{ $category->name }}</span>
                                            </div>
                                            @if (!empty($categoryPercentage[$category->id]))
                                                <?php
                                                $color = 'green';
                                                if ($categoryPercentage[$category->id]['type'] != 'increase') {
                                                    $color = 'red';
                                                }
                                                ?>
                                                <div class="category-cart-content-number {{ $color }} text-center">
                                                    @if ($categoryPercentage[$category->id]['type'] == 'increase')
                                                        <span class="iconify" data-icon="oi:caret-top"></span> +
                                                    @else
                                                        <span class="iconify" data-icon="oi:caret-top"
                                                            data-rotate="180deg"></span>
                                                    @endif
                                                    {{ number_format($categoryPercentage[$category->id]['percentage'], 2, '.', '') }}
                                                    %
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

                {{-- category graph --}}
                {{-- <div class="row margin-top-20 category-cart-graph">
                    <div class="col-md-8 margin-top-20">
                        <h5 class="bold">Your View Statistics</h5>
                        <div class="margin-top-20">
                            <span class="margin-top-20">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi,
                                voluptatibus autem! Similique molestias laudantium qui vero inventore tenetur, enim possimus
                                officia pariatur fuga eligendi voluptates rem dolor recusandae nesciunt iste.</span>
                        </div>
                    </div>
                    <div class="col-md-4 category-cart-graph">
                        <img src="{{ asset('img/category-graph.png') }}" alt="">
                    </div>
                </div> --}}
                {{-- category graph --}}
            </div>
            {{-- End:: Top Category Cart --}}
        </div>
        <div class="col-md-7 col-sm-12 col-12">
            {{-- Start:: Recent Subscriber Cart --}}
            <div class="top-category-cart margin-top-40">
                <span class="category-cart-title bold">Recent Subscriber</span>
                <div class="title-line"></div>
                <div class="row margin-top-40">
                    <div style="overflow-x:auto;">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Email</th>
                                    <th scope="col" class="text-center">Package Name</th>
                                    <th scope="col" class="text-center">Subscribed At</th>
                                    <th scope="col" class="text-center">Expierd Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$recentSubscriber->isEmpty())
                                    @foreach ($recentSubscriber as $data)
                                        <tr>
                                            <td class="text-center">{{ $data->user_name }}</td>
                                            <td class="text-center">{{ $data->user_email }}</td>
                                            <td class="text-center">{{ $data->package_name }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($data->start_date)->format('d F Y') }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($data->end_date)->format('d F Y') }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End:: Recent Subscriber Cart --}}
        </div>
        <div class="col-md-5 col-sm-12 col-12">
            {{-- Start:: Top Videos Cart --}}
            <div class="top-category-cart margin-top-40">
                <span class="category-cart-title bold">Top Videos</span>
                <div class="title-line"></div>
                <div class="row margin-top-40">
                    <div style="overflow-x:auto;">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">SERIAL</th>
                                    <th scope="col" class="text-center">Video Title</th>
                                    <th scope="col" class="text-center">Release Date</th>
                                    <th scope="col" class="text-center">Total View</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $sl = 1; ?>
                                @if (!$populerVideoInfo->isEmpty())
                                    @foreach ($populerVideoInfo as $data)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $sl++ }}</th>
                                            <td class="text-center">{{ $data->title }}</td>
                                            <td class="text-center">{{ $data->year }}</td>
                                            <td class="text-center">{{ $populerVideoCount[$data->id] }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End:: Top Videos Cart --}}
        </div>
    </div>
@stop
@push('custom-js')
    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".right-day-button", function() {
                $(".right-cart-top-month").removeClass('right-cart-top-active');
                $(".right-cart-top-week").removeClass('right-cart-top-active');
                $(".right-cart-top-day").addClass('right-cart-top-active');

                $(".day-view").removeClass('display-none');
                $(".week-view").addClass('display-none');
                $(".month-view").addClass('display-none');
                $(".yearly-view").addClass('display-none');
            });
            $(document).on("click", ".right-week-button", function() {
                $(".right-cart-top-day").removeClass('right-cart-top-active');
                $(".right-cart-top-month").removeClass('right-cart-top-active');
                $(".right-cart-top-week").addClass('right-cart-top-active');

                $(".day-view").addClass('display-none');
                $(".week-view").removeClass('display-none');
                $(".month-view").addClass('display-none');
                $(".yearly-view").addClass('display-none');
            });
            $(document).on("click", ".right-month-button", function() {
                $(".right-cart-top-day").removeClass('right-cart-top-active');
                $(".right-cart-top-week").removeClass('right-cart-top-active');
                $(".right-cart-top-month").addClass('right-cart-top-active');

                $(".day-view").addClass('display-none');
                $(".week-view").addClass('display-none');
                $(".month-view").removeClass('display-none');
                $(".yearly-view").addClass('display-none');
            });

            $(document).on("change", "#cartYearSelect", function(e) {
                e.preventDefault();
                var year = $("#cartYearSelect").val();

                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/dashboard/get-yearly-data',
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        year: year,
                    },
                    complete: function() {
                        $('.loading-spinner').css("display", "none");
                    },
                    success: function(res) {
                        $(".yearly-video").html(res.yearlyVideoView);
                        $(".yearly-comment").html(res.yearlyComment);
                        $(".yearly-report").html(res.yearlyReport);

                        $(".day-view").addClass('display-none');
                        $(".week-view").addClass('display-none');
                        $(".month-view").addClass('display-none');
                        $(".yearly-view").removeClass('display-none');
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {
                        $('.loading-spinner').css("display", "none");
                    }
                }); //ajax
            });
        });
    </script>
@endpush
