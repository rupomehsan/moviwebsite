@extends('frontend.layouts.client.index')
@section('content')
    <div class="container margin-top-100">
        <div class="header-add-section ads-section category-top-header-section row">
            <div class="text-right">
                <img src="{{ URL::to('/') }}/uploads/videoTopBanner.png" alt="">
            </div>
        </div>


        <div class="buy-package-container margin-top-40">
            <div class="row">
                @if (!$package->isEmpty())
                    <div class="owl-carousel package-carousel owl-theme">
                        @foreach ($package as $index => $data)
                            <?php
                            $class = '';
                            if ($index % 3 == 0) {
                                $class = 'blue';
                            }
                            if ($index % 3 == 1) {
                                $class = 'purple';
                            }
                            if ($index % 3 == 2) {
                                $class = 'orrange';
                            }
                            ?>
                            <div class="card item text-center">
                                <div class="single-package-container {{ $class }} margin-top-150">
                                    <div class="single-package-heading text-center">
                                        <div class="single-package-price">
                                            {{ $data->price }}$
                                        </div>
                                        <div class="single-package-title">
                                            <br>
                                            {{ $data->name }} <br> <br>
                                            {{ $data->validity }} Days
                                        </div>

                                        <div class="single-package-triangle"></div>
                                    </div>
                                    <div class="single-package-body">
                                        {{ $data->description }}

                                        <div class="single-package-button">
                                            <button class="package-buy-now-btn margin-top-40" data-id="{{ $data->id }}"
                                                data-name="{{ $data->name }}" data-validity="{{ $data->validity }}"
                                                data-price="{{ $data->price }}" data-userId="{{ auth()->id() }}">
                                                BUY NOW
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- <div class="package-information"></div> --}}
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
        $('.package-carousel').owlCarousel({
            items: 8,
            loop: true,
            autoplay: false,
            responsiveClass: true,
            margin: 20,
            center: true,
            nav: false,
            dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 3
                }
            }
        });

        //select payment method functionality
        $(document).on("click", ".package-buy-now-btn", function() {
            console.log('Here')

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
            $('.loading-spinner').css("display", "flex");


            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };


            
            $.ajax({
                url: window.origin + '/get-package/select-payment-method',
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
                    $(".buy-package-container").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    console.log(jqXhr.status)
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
