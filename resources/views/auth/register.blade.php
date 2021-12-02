@extends('layouts.app')

@section('content')

    <?php
        $pageData = new \stdClass();
        $pageData->userTypes = $userTypes;
        $pageData->industryTypes = $industryTypes;
        $pageData->businessCategories = $businessCategories;
        $pageData->employeeCounts = $employeeCounts;
        $pageData->certifications = $certifications;

        $pageData = json_encode($pageData);
    ?>

    <registration-index
        :page-data="{{ $pageData }}">
    </registration-index>

<!-- <div class="register-container">
    <div class="card-header">{{ __('Sign up') }}</div>
    <div class="container page-register">
        <div class="row justify-content-center">
            <div class="col-md-4 register-column">
                <div class="card borderless">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row mb-1"> -->
                                <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                               <!--  <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder = "Email" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
 -->
                            <!-- <div class="form-group row mb-1"> -->
                                <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                                <!-- <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder = "First Name" required value="{{ old('first_name') }}">

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder = "Last Name" required value="{{ old('last_name') }}">

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-1"> -->
                                <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                                <!-- <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder = "Password" required>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder = "Confirm Password" required>

                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-1"> -->
                                <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                                <!-- <div class="col-md-12">
                                    <input id="contact_no" type="text" class="form-control" name="contact_no" placeholder = "Phone" value="{{ old('contact_no') }}">
                                </div>
                            </div> -->

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

                           <!--  <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-error login-btn-submit">
                                        {{ __('Sign Up') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class = "or-line mb-3 mt-3">
                            <span>{{ __('OR') }}</span>
                        </div>
                        <div class = "text-center"> -->
                            <!-- <button type="button" id = "kakaoLogin" class="btn btn-default login-btn-kakao mb-2">
                                {{ __('Continue with Kakao') }}
                            </button> -->
                            <!-- <div class="fb-login-button" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="true" data-use-continue-as="false" data-width="308px"></div> -->
                            <!-- <button type="submit" class="btn btn-default login-btn-fb mb-2" id = "fbLogin" data-src = "{{url('/fb-redirect')}}">
                                {{ __('Continue with Facebook') }}
                            </button> -->
                            <!-- <a href="{{url('/signin/kakao')}}" class="btn btn-default login-btn-kakao mb-2">{{ __('Continue with Kakao') }}</a>
                            <a href="{{url('/signin/facebook')}}" class="btn btn-primary login-btn-fb mb-2">{{ __('Continue with Facebook') }}</a>
                            <a href="{{url('/signin/google')}}" class="btn btn-default login-btn-gmail mb-2">{{ __('Continue with Google') }}</a> -->
                            <!-- <button type="submit" id = "googleLogin" class="btn btn-default login-btn-gmail mb-2">
                                {{ __('Continue with Google') }}
                            </button> -->
                            <!-- <br>
                            <span class = "mt-3 login-redirect-container">
                                {{ __("Already have an account?") }} 
                                <a href = " {{ route('login') }} " class = "underline black">{{ __('Sign In') }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   -->



@endsection