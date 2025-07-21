@extends('Authentication.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 my-5  registerform">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-10 offset-1">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ __('messages.create_account') }}</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user @error('name') is-invalid @enderror"
                                                placeholder="{{ __('messages.user_name') }}" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                placeholder="{{ __('messages.enter_email') }}" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user @error('phone') is-invalid @enderror"
                                                placeholder="{{ __('messages.enter_phone') }}" name="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                class="form-control form-control-user @error('address') is-invalid @enderror"
                                                placeholder="{{ __('messages.enter_address') }}" name="address" value="{{ old('address') }}">
                                            @error('address')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group position-relative">
                                            <input type="password" id="register-password" name="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                placeholder="{{ __('messages.password') }}" value="{{ old('password') }}">
                                            <button type="button"
                                                class="btn btn-sm bg-transparent border-0 position-absolute"
                                                style="top: 50%; right: 15px; transform: translateY(-50%);"
                                                onclick="togglePassword('register-password', this)">
                                                <i class="fa fa-eye text-secondary"></i>
                                            </button>
                                            @error('password')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group position-relative">
                                            <input type="password" id="register-password-confirmation" name="password_confirmation"
                                                class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                                placeholder="{{ __('messages.repeat_password') }}" value="{{ old('password_confirmation') }}">
                                            <button type="button"
                                                class="btn btn-sm bg-transparent border-0 position-absolute"
                                                style="top: 50%; right: 15px; transform: translateY(-50%);"
                                                onclick="togglePassword('register-password-confirmation', this)">
                                                <i class="fa fa-eye text-secondary"></i>
                                            </button>
                                            @error('password_confirmation')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <input type="submit" value="{{ __('messages.register_account') }}" class="btn btn-primary btn-user btn-block">
                                        <hr>

                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('userLogin') }}">{{ __('messages.already_have_account') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function togglePassword(inputId, el) {
            const input = document.getElementById(inputId);
            const icon = el.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

@endsection
