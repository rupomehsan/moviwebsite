@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Payment Settings</span>
                <div class="title-line"></div>
            </div>
            {{-- title --}}

        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}
    <div class="row margin-top-20 create-body content-details">

        <?php
    $ses_msg = Session::has('success');
    if (!empty($ses_msg)) {
        ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('success'); ?></p>
        </div>
        <?php
    }// 
    $ses_msg = Session::has('error');
    if (!empty($ses_msg)) {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('error'); ?></p>
        </div>
        <?php
    }// ?>

        {{-- Start:: content data --}}
        <div class="col-md-12">
            <form method="POST" enctype="multipart/form-data"
            action="{{ URL::to('admin/payment-settings/update') }}">
            @csrf 

            <div class="row">
                <div class="content-title">
                    <h4 class="bold">PayPal</h4>
                    <div class="title-line"></div>
                </div>

                <div class="col-md-10">
                    <div class="form-group margin-top-20">
                        <label for="mobileApiKey">Paypal Client ID</label>
                        <input name="paypal_client_id" type="text" class="form-control create-form" id="paypal_client_id"
                            placeholder="Enter Paypal Client ID" value="{!! $target->paypal_client_id ?? ''!!}">
                        <span class="text-danger">{{ $errors->first('paypal_client_id') }}</span>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group margin-top-20">
                        <label for="mobileApiId">Paypal Secret</label>
                        <input name="paypal_secret" type="text" class="form-control create-form" id="paypal_secret"
                            placeholder="Enter Paypal Secret" value="{!! $target->paypal_secret ?? ''!!}">
                        <span class="text-danger">{{ $errors->first('paypal_secret') }}</span>
                    </div>
                </div>

                <div class="content-title margin-top-20">
                    <h4 class="bold">Stripe</h4>
                    <div class="title-line"></div>
                </div>

                <div class="col-md-10">
                    <div class="form-group margin-top-20">
                        <label for="mobileApiKey">Stripe Publishable Key</label>
                        <input name="stripe_publishable_key" type="text" class="form-control create-form" id="stripe_publishable_key"
                            placeholder="Enter Stripe Publishable Key" value="{!! $target->stripe_publishable_key ?? ''!!}">
                        <span class="text-danger">{{ $errors->first('stripe_publishable_key') }}</span>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group margin-top-20">
                        <label for="mobileApiId">Stripe Secret Key</label>
                        <input name="stripe_secret_key" type="text" class="form-control create-form" id="stripe_secret_key"
                            placeholder="Enter Stripe Secret Key" value="{!! $target->stripe_secret_key ?? ''!!}">
                        <span class="text-danger">{{ $errors->first('stripe_secret_key') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 actions margin-top-10">
                <button type="submit" class="submit">Save</button>
            </div>
        </form>
        </div>

        <div class="margin-top-40">
            <div class="row">
                <div class="col-md-1 col-sm-2 col-3 smtp-notice smtp-notice-icon">
                    <span class="iconify" data-icon="clarity:bell-outline-badged"></span>
                </div>
                <div class="col-md-10 col-sm-9 col-8 smtp-notice smtp-notice-note">
                    <div class="note-title">Note:</div>
                    <div class="note-description">
                        <span class="iconify" data-icon="el:hand-right"></span> &nbsp; This Data is required
                        otherwise
                        <span class="bold">Payment</span>
                        feature would not work.
                    </div>
                </div>
            </div>

        </div>
        {{-- End:: content data --}}

    </div>
    {{-- End::Content Body --}}


@stop
@push('custom-js')
    <script type="text/javascript">
    </script>
@endpush
