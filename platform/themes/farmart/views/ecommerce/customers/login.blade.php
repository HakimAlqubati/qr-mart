@php Theme::layout('full-width'); @endphp

{!! Theme::partial('page-header', ['withTitle' => false, 'size' => 'xl']) !!}
@php
    $isRegister = !empty($isRegister) ? $isRegister : false;
    $isLogin = !$isRegister;
@endphp
<div class="container">
    <div class="row customer-auth-page py-5 mt-5 justify-content-center">
        <div class="col-sm-9 col-md-6 col-lg-5 col-xl-4">
            <div class="customer-auth-form bg-light pt-1 py-3 px-4">
                <nav class="border-bottom">
                    <div class="nav nav-tabs" role="tablist">
                        <button class="nav-link fs-5 fw-bold text-uppercase @if ($isLogin) active @endif" id="nav-login-tab"
                            data-bs-toggle="tab" data-bs-target="#nav-login-content" type="button" role="tab"
                            aria-controls="nav-login-content" aria-selected="@if ($isLogin) true @else false @endif">{{ __('Log In') }}</button>
                        <button class="nav-link fs-5 fw-bold text-uppercase @if ($isRegister) active @endif" id="nav-register-tab"
                            data-bs-toggle="tab" data-bs-target="#nav-register-content" type="button" role="tab"
                            aria-controls="nav-register-content" aria-selected="@if ($isRegister) true @else false @endif">{{ __('Register') }}</button>
                    </div>
                </nav>
                <div class="tab-content my-3">
                    <div class="tab-pane fade pt-4 @if ($isLogin) show active @endif" id="nav-login-content" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        <h2 class="h6 fw-normal pb-2">{{ __('Log In To Your Account') }}</h2>
                        @if ($isLogin && isset($errors) && $errors->has('confirmation'))
                            <div class="alert alert-danger">
                                <span>{!! BaseHelper::clean($errors->first('confirmation')) !!}</span>
                            </div>
                            <br>
                        @endif
                        <form class="mt-3" method="POST" action="{{ route('customer.login.post') }}">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control @if ($isLogin && $errors->has('email')) is-invalid @endif" type="text" required=""
                                    placeholder="{{ __('Your Email') }}" name="email"
                                    autocomplete="email" value="{{ old('email') }}">
                                @if ($isLogin && $errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="input-group mb-3 input-group-with-text">
                                <input class="form-control @if ($isLogin && $errors->has('password')) is-invalid @endif" type="password" placeholder="{{ __('Password') }}"
                                    aria-label="{{ __('Password') }}" autocomplete="current-password" name="password">
                                <span class="input-group-text">
                                    <a class="lost-password" href="{{ route('customer.password.reset') }}">{{ __('Forgot?') }}</a>
                                </span>
                                @if ($isLogin && $errors->has('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" name="remember" id="remember-me"
                                    type="checkbox" value="1" @if (old('is_vendor') == 1) checked="checked" @endif>
                                <label class="form-check-label" for="remember-me">{{ __('Remember me?') }}</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">{{ __('Log in') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade pt-4 @if ($isRegister) show active @endif" id="nav-register-content" role="tabpanel"
                        aria-labelledby="nav-profile-tab">
                        <h2 class="h6 fw-normal pb-2">{{ __('Register An Account') }}</h2>
                        <form method="POST" action="{{ route('customer.register.post') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input class="form-control @if ($isRegister && $errors->has('name')) is-invalid @endif"
                                       name="name" id="name-register" type="text" value="{{ old('name') }}" placeholder="{{ __('Your Name') }}">
                                @if ($isRegister && $errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control @if ($isRegister && $errors->has('email')) is-invalid @endif"
                                    type="email" required="required" placeholder="{{ __('Email Address') }}"
                                    name="email" autocomplete="email" value="{{ old('email') }}">
                                @if ($isRegister && $errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control @if ($isRegister && $errors->has('password')) is-invalid @endif"
                                    type="password" placeholder="{{ __('Password') }}" aria-label="{{ __('Password') }}"
                                    autocomplete="new-password" name="password">
                                @if ($isRegister && $errors->has('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control @if ($isRegister && $errors->has('password_confirmation')) is-invalid @endif"
                                    type="password" placeholder="{{ __('Password confirmation') }}" aria-label="{{ __('Password') }}" name="password_confirmation">
                                @if ($isRegister && $errors->has('password_confirmation'))
                                    <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>
                            @if (is_plugin_active('marketplace'))
                                <div class="show-if-vendor" @if (old('is_vendor') != 1) style="display: none" @endif>
                                    @include(Theme::getThemeNamespace() . '::views.marketplace.includes.become-vendor-form', compact('isRegister'))
                                </div>
                                <div class="vendor-customer-registration">
                                    <div class="form-check my-1">
                                        <input class="form-check-input" name="is_vendor" value="0" id="customer-role-register"
                                            type="radio" @if (old('is_vendor') != 1) checked="checked" @endif>
                                        <label class="form-check-label" for="customer-role-register">{{ __('I am a customer') }}</label>
                                    </div>
                                    <div class="form-check my-1 mb-3">
                                        <input class="form-check-input" id="vendor-role-register" value="1"
                                            type="radio" name="is_vendor" @if (old('is_vendor') == 1) checked="checked" @endif>
                                        <label class="form-check-label" for="vendor-role-register">{{ __('I am a vendor') }}</label>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <p>{{ __('Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.') }}</p>
                            </div>
                            <div class="form-check mb-3">
                                <input type="hidden" name="agree_terms_and_policy" value="0">
                                <input class="form-check-input" type="checkbox" name="agree_terms_and_policy" id="agree-terms-and-policy" value="1" @if (old('agree_terms_and_policy') == 1) checked @endif>
                                <label for="agree-terms-and-policy">{{ __('I agree to terms & Policy.') }}</label>
                                @if ($errors->has('agree_terms_and_policy'))
                                    <div class="mt-1">
                                        <span class="text-danger small">{{ $errors->first('agree_terms_and_policy') }}</span>
                                    </div>
                                @endif
                            </div>

                            @if (is_plugin_active('captcha') && setting('enable_captcha') && get_ecommerce_setting('enable_recaptcha_in_register_page', 0))
                                <div class="form-group mb-3">
                                    {!! Captcha::display() !!}
                                </div>
                            @endif
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">{{ __('Register') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="bg-light pt-1 px-5 pb-3">
                {!! apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, \Botble\Ecommerce\Models\Customer::class) !!}
            </div>
        </div>
    </div>
</div>
