@extends('layouts.login-reg')
@section('page-title')
    {{__('Login')}}
@endsection
@php
    $logo=asset(Storage::url('uploads/logo/'));
@endphp
@section('content')
<div class="auth-fluid" style="background-image: url({{ asset('public/new_assets/images/bg-auth.jpg') }});">
    <!--Auth fluid left content -->
    <div class="auth-fluid-form-box">
        <div>
            <div class="card-body">

                <!-- Logo -->
                <div class="auth-brand text-center">
                    <div class="auth-logo">
                        <a href="{{ route('login') }}" class="logo auth-logo-dark">
                            <span class="logo-lg">
                                <img src="{{$logo.'/logo.png'}}" alt="" height="70">
                            </span>
                        </a>

                        <a href="{{ route('login') }}" class="logo auth-logo-light">
                            <span class="logo-lg">
                                <img src="{{$logo.'/logo.png'}}" alt="" height="70">
                            </span>
                        </a>
                    </div>
                </div>

                <!-- title-->
                <div class="text-center">
                    <h4 class="mt-0">{{ __('Login') }}</h4>
                    <p class="text-muted mb-2">Enter your email address and password to access account.</p>
                </div>

                <!-- form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" required autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="invalid-feedback">
                            {{__('Please fill in your email')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">{{ __('Password') }}</label>
                            <div class="float-right">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-small" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                            @enderror

                        </div>
                        <div class="invalid-feedback">
                            {{ __('please fill in your password') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block" tabindex="4">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>

                <!-- <div class="text-center mt-4">
                    <p class="text-muted">{{__("Don't have an account?")}} <a href="{{ route('register') }}">{{ __('Create One') }}</a></p>
                </div> -->

                <!-- end form-->

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">{{(Utility::getValByName('footer_text')) ? Utility::getValByName('footer_text') :  __('Copyright Vital Shield') }} {{ date('Y') }}</p>
                </footer>

            </div> <!-- end .card-body -->
        </div>
    </div>
    <!-- end auth-fluid-form-box-->
</div>

@endsection
