@extends('frontend.layouts.client.index')
@section('content')
    <?php
    $logo = \App\Models\Setting::first();
    ?>
    <!-- video section start -->
    <section class="video ptb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10 margin-top-40 legal-information">
                    @if (request('type') == 'about_us')
                        <h3>About Us</h3>
                        <div class="legal-information-description margin-top-20">
                            {!! $logo->about_us ?? '' !!}
                        </div>
                    @elseif(request('type') == 'terms_policy')
                        <h3>Term s & Conditions</h3>
                        <div class="legal-information-description margin-top-20">
                            {!! $logo->terms_policy ?? '' !!}
                        </div>
                    @elseif(request('type') == 'privacy_policy')
                        <h3>Privecy Policy</h3>
                        <div class="legal-information-description margin-top-20">
                            {!! $logo->privacy_policy ?? '' !!}
                        </div>
                    @elseif(request('type') == 'cookies_policy')
                        <h3>Cookies Policy</h3>
                        <div class="legal-information-description margin-top-20">
                            {!! $logo->cookies_policy ?? '' !!}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- video section end -->
@endsection
@push('custom-js')
@endpush
