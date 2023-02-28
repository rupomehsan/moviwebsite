<?php
$currentControllerName = Request::segment(2);
$currentFullRouteName = Route::getFacadeRoot()
    ->current()
    ->uri();

$logo = \App\Models\Setting::select('logo', 'logo_icon')->first();
?>

{{-- Start:: Sidebar --}}
<div class="side-bar col-md-2 col-sm-12">


    <div class="logo-section">
        <div class="main-logo sidebar-span">
            <a href="/admin/dashboard">
                @if (!empty($logo->logo))
                    <img src="{{ URL::to('/') }}/uploads/{{ $logo->logo }}" alt="No Logo" />
                @else
                    <img src="{{ URL::to('/') }}/uploads/logo.jpg" alt="" />
                @endif
            </a>
        </div>

        <div class="logo-icon ">
            <a href="/admin/dashboard">
                @if (!empty($logo->logo_icon))
                    <img src="{{ URL::to('/') }}/uploads/{{ $logo->logo_icon }}" alt="No Logo" />
                @else
                    <img src="{{ URL::to('/') }}/uploads/logo.jpg" alt="" />
                @endif
            </a>
        </div>
    </div>
    <div class="span-icon">
        <button class="sidebar-span-btn span-hide">
            <span class="iconify" data-icon="fluent:text-grammar-arrow-left-24-filled"></span>
        </button>
    </div>

    {{-- Start:: Nav bar --}}
    <nav>
        <ul>
            <li>
                <a href="/admin/dashboard" class="{{ $currentControllerName == 'dashboard' || '' ? 'active' : '' }}">
                    <span class="iconify" data-icon="ic:sharp-space-dashboard"></span>
                    <span class="sidebar-span">Dashboard</span>
                </a>
            </li>
        </ul>

        <?php
        $accessControllArr = json_decode(auth()->user()->access) ?? [];
        ?>

        @if (in_array('manage', $accessControllArr) || in_array(auth()->user()->user_role_id, [1]))
            <span class="nav-section sidebar-span">Manage</span>
            <ul>
                <li>
                    <a href="/admin/category" class="{{ $currentControllerName == 'category' ? 'active' : '' }}">
                        <span class="iconify" data-icon="ic:outline-category"></span>
                        <span class="sidebar-span">Categories</span>
                    </a>
                </li>
                {{-- <li>
                <a href="/artist" class="{{ ($currentControllerName == 'artist') ? 'active' : '' }}">
                    <span class="iconify" data-icon="fluent:video-person-28-filled"></span>
                    <span>Artists</span>
                </a>
            </li> --}}
                <li>
                    <a href="/admin/celebrity" class="{{ $currentControllerName == 'celebrity' ? 'active' : '' }}">
                        <span class="iconify" data-icon="fluent:video-person-28-filled"></span>
                        <span class="sidebar-span">Artist</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/genres" class="{{ $currentControllerName == 'genres' ? 'active' : '' }}">
                        <span class="iconify" data-icon="ic:sharp-theater-comedy"></span>
                        <span class="sidebar-span">Genres</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/tv-channel" class="{{ $currentControllerName == 'tv-channel' ? 'active' : '' }}">
                        <span class="iconify" data-icon="gg:tv"></span>
                        <span class="sidebar-span">Tv Channels</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/country" class="{{ $currentControllerName == 'country' ? 'active' : '' }}">
                        <span class="iconify" data-icon="bx:bx-world"></span>
                        <span class="sidebar-span">Countries</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/top-feature" class="{{ $currentControllerName == 'top-feature' ? 'active' : '' }}">
                        <span class="iconify" data-icon="cil:arrow-top"></span>
                        <span class="sidebar-span">Top Features</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/sponsor" class="{{ $currentControllerName == 'sponsor' ? 'active' : '' }}">
                        <span class="iconify" data-icon="mdi:account-convert-outline"></span>
                        <span class="sidebar-span">Sponsors</span>
                    </a>
                </li>
            </ul>
        @endif

        @if (in_array('video', $accessControllArr) || in_array(auth()->user()->user_role_id, [1]))
            <span class="nav-section sidebar-span">Video</span>
            <ul>
                <li>
                    <a href="/admin/series/series-category-view"
                        class="{{ $currentControllerName == 'series' ? 'active' : '' }}">
                        <span class="iconify" data-icon="carbon:save-series"></span>
                        <span class="sidebar-span">Manage Series</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/video" class="{{ $currentControllerName == 'video' ? 'active' : '' }}">
                        <span class="iconify" data-icon="dashicons:format-video"></span>
                        <span class="sidebar-span">Video</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/request-movie" class="{{ $currentControllerName == 'request-movie' ? 'active' : '' }}">
                        <span class="iconify" data-icon="clarity:video-gallery-line"></span>
                        <span class="sidebar-span">Requested Movies</span>
                    </a>
                </li>
            </ul>
        @endif


        @if (in_array('administration', $accessControllArr) || in_array(auth()->user()->user_role_id, [1]))
            <span class="nav-section sidebar-span">Administration</span>
            <ul>
                {{-- <li>
                <a href="#">
                    <span class="iconify" data-icon="gridicons:user-add"></span>
                    <span>Add Admin</span>
                </a>
            </li> --}}
                <li>
                    <a href="/admin/admin" class="{{ $currentControllerName == 'admin' ? 'active' : '' }}">
                        <span class="iconify" data-icon="fa-solid:user-cog"></span>
                        <span class="sidebar-span">Manage Admin</span>
                    </a>
                </li>
            </ul>
        @endif


        @if (in_array('user', $accessControllArr) || in_array(auth()->user()->user_role_id, [1]))
            <span class="nav-section sidebar-span">User</span>
            <ul>
                <li>
                    <a href="/admin/user" class="{{ $currentControllerName == 'user' ? 'active' : '' }}">
                        <span class="iconify" data-icon="fa-solid:user-cog"></span>
                        <span class="sidebar-span">Manage User</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/subscriber" class="{{ $currentControllerName == 'subscriber' ? 'active' : '' }}">
                        <span class="iconify" data-icon="eos-icons:subscriptions-created-outlined"></span>
                        <span class="sidebar-span">Subscriber</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/comment" class="{{ $currentControllerName == 'comment' ? 'active' : '' }}">
                        <span class="iconify" data-icon="fluent:comment-24-filled"></span>
                        <span class="sidebar-span">Comment</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/report" class="{{ $currentControllerName == 'report' ? 'active' : '' }}">
                        <span class="iconify" data-icon="ic:baseline-report"></span>
                        <span class="sidebar-span">Report</span>
                    </a>
                </li>
            </ul>
        @endif


        @if (in_array('settings', $accessControllArr) || in_array(auth()->user()->user_role_id, [1]))
            <span class="nav-section sidebar-span">Settings</span>
            <ul>
                <li>
                    <a href="/admin/advertisement" class="{{ $currentControllerName == 'advertisement' ? 'active' : '' }}">
                        <span class="iconify" data-icon="bi:badge-ad-fill"></span>
                        <span class="sidebar-span">Advertisement</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/notification" class="{{ $currentControllerName == 'notification' ? 'active' : '' }}">
                        <span class="iconify" data-icon="ic:sharp-notification-add"></span>
                        <span class="sidebar-span">Notifications</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/basic-settings"
                        class="{{ $currentControllerName == 'basic-settings' ? 'active' : '' }}">
                        <span class="iconify" data-icon="eva:settings-2-fill"></span>
                        <span class="sidebar-span">Basic Settings</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/video-settings"
                        class="{{ $currentControllerName == 'video-settings' ? 'active' : '' }} {{ $currentControllerName == 'video-settings-category' ? 'active' : '' }}">
                        <span class="iconify" data-icon="ant-design:play-circle-filled"></span>
                        <span class="sidebar-span">Video Settings</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/smtp-settings" class="{{ $currentControllerName == 'smtp-settings' ? 'active' : '' }}">
                        <span class="iconify" data-icon="fluent:mail-24-regular"></span>
                        <span class="sidebar-span">SMTP Settings</span>
                    </a>
                </li>
            </ul>
        @endif


        @if (in_array('subscription', $accessControllArr) || in_array(auth()->user()->user_role_id, [1]))
            <span class="nav-section sidebar-span">Subscription</span>
            <ul>
                <li>
                    <a href="/admin/package" class="{{ $currentControllerName == 'package' ? 'active' : '' }}">
                        <span class="iconify" data-icon="iconoir:packages"></span>
                        <span class="sidebar-span">Package</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/package-subscriber" class="{{ $currentControllerName == 'package-subscriber' ? 'active' : '' }}">
                        <span class="iconify" data-icon="fluent:premium-person-20-regular"></span>
                        <span class="sidebar-span">Subscriber</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/payment-settings" class="{{ $currentControllerName == 'payment-settings' ? 'active' : '' }}">
                        <span class="iconify" data-icon="material-symbols:payments-outline-rounded"></span>
                        <span class="sidebar-span">Payment Settings</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/offline-payment" class="{{ $currentControllerName == 'offline-payment' ? 'active' : '' }}">
                        <span class="iconify" data-icon="fluent:payment-24-filled"></span>
                        <span class="sidebar-span">Offline Payment</span>
                    </a>
                </li>
            </ul>
        @endif

    </nav>
    {{-- End:: Nav bar --}}
</div>
{{-- End:: Sidebar --}}
