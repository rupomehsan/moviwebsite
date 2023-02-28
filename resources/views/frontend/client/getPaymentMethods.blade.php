@if (!empty($paymentSettings))
    <h3 class="text-center">Select Your Preferable Payment Method</h3>

    <div class="row margin-top-40">
        <div class="col-md-12 text-center">
            @if (!empty($paymentSettings->paypal_client_id) && !empty($paymentSettings->paypal_secret))
                <button type="button" class="paypal-select-btn payment-method-select-btn" data-id="{{ request('id') }}"
                    data-validity="{{ request('validity') }}" data-name="{{ request('name') }}" data-transactionId=""
                    data-price="{{ request('price') }}">
                    <span class="iconify" data-icon="logos:paypal"></span>
                    <span class="paypal-pay">Pay</span><span class="paypal-pal">Pal</span>
                </button>
                <br>
            @endif

            @if (!empty($paymentSettings->stripe_publishable_key))
                {{-- stripe btn --}}
                <form action="payment/stripe-transaction-data-store" method="POST">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ request('id') }}">
                    {{-- <input type="hidden" name="name" value="{{ request('name') }}"> --}}
                    {{-- <input type="hidden" name="validity" value="{{ request('validity') }}"> --}}
                    {{-- <input type="hidden" name="price" value="{{ request('price') }}"> --}}
                    <button type="submit" class="stripe-select-btn payment-method-select-btn margin-top-20"
                        data-id="{{ request('id') }}" data-validity="{{ request('validity') }}"
                        data-transactionId="" data-name="{{ request('name') }}" data-price="{{ request('price') }}">
                        Stripe
                    </button>
                </form>
            @endif
        </div>
    </div>
@else
    <h3 class="red text-center">This Feature Currently Switched Off !</h3>
@endif
