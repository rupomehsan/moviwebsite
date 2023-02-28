@extends('layouts.app')

@section('content')
    <div class="row login-content">
        <div class="col-md-4">
            <div class="login-logo text-center">
                <?php
                $title = \App\Models\Setting::first();
                ?>
                @if (!empty($title->logo))
                    <img src="{{ URL::to('/') }}/uploads/{{ $title->logo }}" alt="logo" />
                @else
                    <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                @endif
            </div>
            <div class="login-submit-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group login-form">
                        <label for="email" class="">Email</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" placeholder="Type your email" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group login-form margin-top-40">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Type your password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-danger login-submit">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8 login-welcome bold">
            <div class="text-center">
                <h1>Welcome to our <span>Website</span> </h1>
                <span>Login to access your admin account</span>
            </div>
        </div>
    </div>
@endsection
