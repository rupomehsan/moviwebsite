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
                    <h3>Privecy Policy</h3>
                    <div class="legal-information-description margin-top-20">
                        {!! $logo->privacy_policy ?? '' !!}
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- video section end -->
@endsection
@push('custom-js')
@endpush
