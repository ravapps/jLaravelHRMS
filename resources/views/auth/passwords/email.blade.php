@extends('layouts.login-reg')
@section('page-title')
    {{__('Forgot Password')}}
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
                            <h4 class="mt-0">{{ __('Forgot Password') }}</h4>
                            <p class="text-muted mb-2">{{ __('We will send a link to reset your password') }}</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- form -->
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>



                        </form>
                        <div class="form-group text-center">
                            <label>OR</label>
                        </div>

                        <div class="mt-2 text-muted text-center">
                            <a href="{{ route('login') }}" class="btn btn-light">{{__('Login')}}</a>
                        </div>
                        <!-- end form-->

                        <!-- Footer-->
                        <footer class="footer footer-alt">
                            <p class="text-muted">{{(Utility::getValByName('footer_text')) ? Utility::getValByName('footer_text') :  __('Copyright HRMGo') }} {{ date('Y') }}</p>
                        </footer>

                    </div> <!-- end .card-body -->
                </div>
            </div>
            <!-- end auth-fluid-form-box-->

        </div>


@endsection
