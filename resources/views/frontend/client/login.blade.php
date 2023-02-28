@extends('frontend.layouts.client.index')
@section('content')
    <div class="frontend-login-pannel row margin-top-150">
        <div class="frontend-login-title col-md-12 text-center">Login Here</div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                    </div>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" placeholder="Type your email" required autocomplete="email"
                        aria-describedby="basic-addon1">


                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3 margin-top-40">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Password</span>
                    </div>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="Type your password" required autocomplete="current-password"
                        aria-describedby="basic-addon2">


                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group text-center margin-top-40">
                    <button type="submit" class="btn btn-danger login-submit login-submit-button">
                        LOG IN
                    </button>
                </div>
            </form>

            <div class="row forgot-registration">
                <div class="col-md-12 text-center margin-top-20">
                    <p> <a href="/forgot-password-email" class="blue-text">Forgot Password?</a></p>
                </div>
                <div class="col-md-12 margin-top-20 text-center">
                    <span>Need An Account ?</span>
                    <a href="/registration" class="blue-text">Register Now</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
    <script>
    </script>
@endpush
