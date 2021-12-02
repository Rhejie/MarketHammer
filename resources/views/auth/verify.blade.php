{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.app')

@section('content')
<div class="register-container">
    <div class="card-header" style="font-size: 18px;">{{ __('VERIFY EMAIL') }}</div>
    <div class="container page-register">
        <div class="row justify-content-center" style="padding: 10px">
            <div class="card" style="margin-top: 20px;">
                <div class="card-body" style="font-size: 15px; text-align: center;">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
    
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="width: auto;">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
            <span class = "mt-3" style="display: block; width: 100%; text-align:center;">
                <a href = " {{ route('logout') }} " class = "underline black" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">{{ __('Back to login page') }}</a>
            </span>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>  



@endsection
