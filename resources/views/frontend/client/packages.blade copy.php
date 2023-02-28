@extends('frontend.layouts.client.index')
@section('content')
    <div class="container margin-top-200">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="package-information">
                    <h3 class="text-center">Select Your Desire Package</h3>

                    <div class="row margin-top-40">
                        <div class="package-name-pannel">
                            <ul class="text-center">
                                @if (!$package->isEmpty())
                                    <?php $totalPackage = sizeof($package);
                                    $counter = 0; ?>
                                    @foreach ($package as $data)
                                        <?php $counter++; ?>
                                        <li>
                                            <button data-id="{{ $data->id }}"
                                                class="single-package-name margin-top-10 {{ $counter == 1 ? 'first-package-name active-package-name' : '' }}
                                            {{ $counter == $totalPackage ? 'last-package-name' : '' }}"
                                                type="button">
                                                {{ $data->name }}
                                            </button>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="package-details-pannel text-center margin-top-40">
                            <div class="single-package">

                                @if (!$package->isEmpty())
                                    @foreach ($package as $data)
                                        <div class="package-period margin-top-20"><span
                                                id="packagePeriod">{{ $data->validity }}</span> Days</div>
                                        <div class="package-price margin-top-40">
                                            <span class="iconify" data-icon="fa:dollar"></span>&nbsp;<span
                                                id="packagePrice">{{ $data->price }}</span>
                                        </div>

                                        <button class="buy-now-btn margin-top-40" data-id="{{ $data->id }}"
                                            data-name="{{ $data->name }}" data-validity="{{ $data->validity }}"
                                            data-price="{{ $data->price }}" data-userId="{{ auth()->id() }}">
                                            BUY NOW
                                        </button>
                                    @break
                                @endforeach
                                @else 
                                <h3 class="red">No Package Are Available !</h3>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- <div class="row margin-top-40">
                        @if (!$package->isEmpty())
                            @foreach ($package as $data)
                                <div class="col-md-4 col-sm-6 col-12 margin-top-20">
                                    <a href="#" data-id="{{ $data->id }}" class="select-package-btn" data-toggle="modal"
                                        data-target="#selectMethod">
                                        <div class="single-package">
                                            <div class="package-price"><span class="iconify"
                                                    data-icon="fa:dollar"></span> {{ $data->price }}*</div>
                                            <div class="package-period">{{ $data->validity }} Days</div>
                                            <div class="package-name">{{ $data->name }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div> --}}
            </div>
        </div>
    </div>
</div>

{{-- Start:: Payment Pay Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="payPaymentModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="margin-top-10 payable-details">Your Selected Package : <span
                        class="payable-package payable-details-value"></span></h4>
                <h4 class="margin-top-10 payable-details">Package Validity : <span
                        class="payable-validity payable-details-value"></span></h4>
                <h4 class="margin-top-10 payable-details">Package Price : <span
                        class="payable-price payable-details-value"></span></h4>
                <input type="hidden" name="package_id" class="package_id">
                <div id="paymentTypeBtn" class="margin-top-40"></div>
            </div>
        </div>
    </div>
</div>
{{-- End:: Payment Pay Modal --}}
@endsection

@push('custom-js')
<?php
$gatWays = \App\Models\PaymentGatway::first();
?>
<script src="https://www.paypal.com/sdk/js?client-id={{ $gatWays->paypal_client_id ?? '' }}&currency=USD"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    //change package details
    $(document).on("click", ".single-package-name", function() {
        var id = $(this).data("id");
        $('.active-package-name').removeClass("active-package-name");
        $(this).addClass("active-package-name");

        $('.loading-spinner').css("display", "flex");
        $.ajax({
            url: window.origin + 'get-package/single',
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
            },
            complete: function() {
                $('.loading-spinner').css("display", "none");
            },
            success: function(res) {
                // console.log(res);
                $("#packagePeriod").html(res.data.validity);
                $("#packagePrice").html(res.data.price);
                $('.buy-now-btn').attr('data-id', res.data.id);
                $('.buy-now-btn').attr('data-name', res.data.name);
                $('.buy-now-btn').attr('data-validity', res.data.validity);
                $('.buy-now-btn').attr('data-price', res.data.price);
            },
            error: function(jqXhr, ajaxOptions, thrownError) {
                $('.loading-spinner').css("display", "none");
            }
        }); //ajax

    });

    //select payment method functionality
    $(document).on("click", ".buy-now-btn", function() {
        var userId = $(this).attr("data-userId");
        if (userId == "") {
            swal.fire({
                title: 'Please Login Your Account',
                text: "You cannot take a package without logging in!",
                icon: 'warning',
            });
            return false
        }
        var id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var validity = $(this).attr("data-validity");
        var price = $(this).attr("data-price");
        // alert(id);

        $('.loading-spinner').css("display", "flex");
        $.ajax({
            url: window.origin + 'get-package/select-payment-method',
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                name: name,
                validity: validity,
                price: price,
            },
            complete: function() {
                $('.loading-spinner').css("display", "none");
            },
            success: function(res) {
                $(".package-information").html(res.html);
            },
            error: function(jqXhr, ajaxOptions, thrownError) {
                $('.loading-spinner').css("display", "none");
            }
        }); //ajax
    });

    //get paypal btn
    let id = null;
    let price = null;
    let transactionId = null;

    //paypal payment initialised
    $(document).on('click', '.paypal-select-btn', function() {
        
        id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var validity = $(this).attr("data-validity");
        price = $(this).attr("data-price");

        // package details show
        $('.payable-package').html(name);
        $('.payable-validity').html(validity + ' Days');
        $('.payable-price').html(price + ' $');
        $('.package_id').val(id);
        $('#payPaymentModal').modal('show');

        $.ajax({
            url: window.origin + 'payment/transaction-initialise',
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                package_id: id,
                payment_method: 'paypal',
            },
            success: function(res) {
                transactionId = res.transactionId;
            },
        }); //ajax
    });

    //stripe payment initialised
    // $(document).on('click', '.stripe-select-btn', function() {
    //     id = $(this).attr("data-id");
    //     var name = $(this).attr("data-name");
    //     var validity = $(this).attr("data-validity");
    //     price = $(this).attr("data-price");

    //     // package details show
    //     $('.payable-package').html(name);
    //     $('.payable-validity').html(validity + ' Days');
    //     $('.payable-price').html(price + ' $');
    //     $('.package_id').val(id);
    //     $('#payPaymentModal').modal('show');

    //     $.ajax({
    //         url: window.origin + 'payment/transaction-initialise',
    //         type: "POST",
    //         dataType: "json",
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: {
    //             package_id: id,
    //             payment_method: 'stripe',
    //         },
    //         success: function(res) {
    //             transactionId = res.transactionId;
    //         },
    //     }); //ajax
    // });

    //paypal integration
    const paypalButtonsComponent = paypal.Buttons({
        style: {
            color: "gold",
            shape: "rect",
            layout: "vertical"
        },
        createOrder: (data, actions) => {
            const createOrderPayload = {
                intent: "CAPTURE",
                purchase_units: [{
                    reference_id: "REFID-000-1001",
                    amount: {
                        value: price
                    }
                }],
            };
            return actions.order.create(createOrderPayload);
        },
        onApprove: (data, actions) => {
            console.log(data);
            $.ajax({
                url: window.origin + 'payment/paypal-transaction-data-store',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    data: data,
                    transactionId: transactionId,
                },
                success: function(res) {
                    toastr.success('You are subscribed now!', res);
                    setTimeout(location.reload.bind(location), 1000);
                },
            }); //ajax
        },
        onError: (err) => {
            console.error('An error prevented the buyer from checking out with PayPal');
        }
    });
    paypalButtonsComponent
        .render("#paymentTypeBtn")
        .catch((err) => {
            console.error('PayPal Buttons failed to render');
        });



    //stripe integration
    // $(document).on('click', '.stripe-select-btn', function() {
    //     var id = $(this).attr("data-id");
    //     $.ajax({
    //         url: window.origin + 'payment/stripe-transaction-data-store',
    //         type: "POST",
    //         dataType: "json",
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: {
    //             package_id: id,
    //             payment_method: 'stripe',
    //         },
    //         success: function(res) {
    //             toastr.success('You are subscribed now!', res);
    //             setTimeout(location.reload.bind(location), 1000);
    //         },
    //     }); //ajax
    // });
</script>
@endpush
