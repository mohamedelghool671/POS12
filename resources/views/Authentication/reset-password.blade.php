@extends('Authentication.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9 mt-5">
            <div class="card o-hidden border-0 my-5 loginform">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-10 offset-1">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="mb-4">{{ __('messages.reset_password') }}</h1>
                                </div>

                                <form method="POST" action="{{ route('password.store') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $request->token }}">

                                    <!-- Email Field -->
                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            placeholder="{{ __('messages.enter_email') }}" name="email"
                                            value="{{ old('email', $request->email) }}">
                                        @error('email')
                                            <small class="invalid-feedback d-block">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Password Field -->
                                    <div class="form-group position-relative">
                                        <input type="password" id="reset-password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            placeholder="{{ __('messages.new_password') }}" name="password">
                                        <button type="button"
                                            class="btn btn-sm bg-transparent border-0 position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"
                                            onclick="togglePassword('reset-password', this)">
                                            <i class="fa fa-eye text-secondary"></i>
                                        </button>
                                        @error('password')
                                            <small class="invalid-feedback d-block">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password Field -->
                                    <div class="form-group position-relative">
                                        <input type="password" id="reset-password-confirmation"
                                            class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                            placeholder="{{ __('messages.confirm_password') }}" name="password_confirmation">
                                        <button type="button"
                                            class="btn btn-sm bg-transparent border-0 position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"
                                            onclick="togglePassword('reset-password-confirmation', this)">
                                            <i class="fa fa-eye text-secondary"></i>
                                        </button>
                                        @error('password_confirmation')
                                            <small class="invalid-feedback d-block">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Token Error -->
                                    @error('token')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <!-- Submit -->
                                    <input type="submit" value="{{ __('messages.reset_password') }}" class="btn btn-primary btn-user btn-block">
                                </form>

                                <!-- Session Message -->
                                @if (session('status'))
                                    <div class="alert alert-success mt-3">{{ session('status') }}</div>
                                @endif

                                <div class="text-center mt-3">
                                    <a class="small text-dark" href="{{ route('userLogin') }}">{{ __('messages.back_to_login') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toggle Password Script -->
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
