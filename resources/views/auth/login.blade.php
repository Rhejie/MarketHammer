@extends('layouts.app')

@section('content')
<div class="container page-login">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card borderless">
                <div class="card-header">
                    <h3>{{ __('Sign In') }}</h3>
                    <p>{{ __('Welcome back ! Sign in to access the Market Hammer.') }}</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mb-1">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder = "Username" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder = "Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6"></div>

                            <div class="col-md-6">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link forgot-password text-right" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-error login-btn-submit">
                                    {{ __('Sign In') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class = "text-center">
                        <span class = "mt-3">
                            {{ __("No account yet?") }}
                            <a href=" {{ url('/register') }} " class = "yellow">{{ __('Create an Account') }}</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('content')
<script type="text/javascript">

</script>
@endsection


