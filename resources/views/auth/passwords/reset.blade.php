@extends('layouts.login-reg')
@php
    $logo=asset(Storage::url('uploads/logo/'));
@endphp
@section('page-title')
    {{__('Forgot Password')}}
@endsection
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
                            <h4 class="mt-0">{{__('Reset Password')}}</h4>
                            <p class="text-muted mb-2">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                        </div>

                        <!-- form -->
                        {{Form::open(array('route'=>'password.update','method'=>'post','id'=>'loginForm'))}}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            {{Form::label('email',__('E-Mail Address'))}}
                            {{Form::text('email',null,array('class'=>'form-control'))}}
                            @error('email')
                            <span class="invalid-email text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{Form::label('password',__('Password'))}}
                            {{Form::password('password',array('class'=>'form-control'))}}
                            @error('password')
                            <span class="invalid-password text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{Form::label('password_confirmation',__('Password Confirmation'))}}
                            {{Form::password('password_confirmation',array('class'=>'form-control'))}}
                            @error('password_confirmation')
                            <span class="invalid-password_confirmation text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group mb-0 text-center">
                            {{Form::submit(__('Reset Password'),array('class'=>'btn btn-success btn-block','id'=>'resetBtn'))}}
                        </div>
                        {{Form::close()}}
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
