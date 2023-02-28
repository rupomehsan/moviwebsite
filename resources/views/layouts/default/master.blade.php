@include('layouts.default.header')
<body>
    <div class="full-body">
        <div class="container-fluid">
            <div class="row">
                @include('layouts.default.sidebar')
                <div class="main-body  col-md-10  col-sm-12 col-12">
                    @include('layouts.default.topNavbar')
                    <div class="content-body">
                        @yield('data_count')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="loading-spinner display-none-important">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    @include('layouts.default.footerScript')
</body>
</html>

