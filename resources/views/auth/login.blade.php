@extends('layouts.master')

@section('header')
    <x-navbar></x-navbar>
@endsection
@section('login')
<div class="container-fluid">
    <br> <br>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <br><br>
            <x-carousel></x-carousel>
        </div>
        <div class="col-lg-4">
            <br><br><br><br>
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf



                            <div class="col-12 mb-3">
                                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="col-12 mb-3">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>



                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('Login') }}
                                </button>

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
                            </div>

                    </form>
                </div>
            </div>
            <div style="font-size: 12px" class="text-center">
                <div class="copyright">
                    <i class="bi bi-c-circle-fill"></i> Copyright <strong><span>2023</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Developed by <a href="https://www.facebook.com/alonzojhunnorman" target="_blank">Jhun Norman Alonzo</a>
                </div>
            </div>

        </div>
    </div>


</div>


@endsection
