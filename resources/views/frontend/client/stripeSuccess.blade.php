@extends('frontend.layouts.client.index')
@section('content')
    
<div class="container margin-top-100">
    <div class="header-add-section ads-section category-top-header-section row">
        <div class="text-right">
            <img src="{{ URL::to('/') }}/uploads/videoTopBanner.png" alt="">
        </div>
    </div>
    
    <div class="margin-top-40">
        <div class="stript-success-message">
            Congratulations! You are now our premium member.
        </div>
    </div>
</div>

@endsection

@push('custom-js')
@endpush
