@extends('Authentication.layouts.master')

@section('content')
<div class="container">
    @if (session('status'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Swal.fire({
            title: '{{ __("messages.success") }}!',
            text: "{{ session('status') }}",
            icon: 'success',
            confirmButtonText: '{{ __("messages.ok") }}'
        });
    </script>
    @endif


    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9 mt-5">
            <div class="card o-hidden border-0 my-5 loginform">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-10 offset-1">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="mb-4">{{ __('messages.login') }}</h1>
                                </div>
                                <form class="user" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Field -->
                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            placeholder="{{ __('messages.enter_email') }}" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Password Field with toggle -->
                                    <div class="form-group position-relative">
                                        <input type="password" id="login-password"
                                            class="form-control form-control-user"
                                            placeholder="{{ __('messages.password') }}" name="password">

                                        <button type="button"
                                            class="btn btn-sm bg-transparent border-0 position-absolute"
                                            style="top: 50%; right: 15px; transform: translateY(-50%);"
                                            onclick="togglePassword('login-password', this)">
                                            <i class="fa fa-eye text-secondary"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror

                                    <!-- Submit -->
                                    <input type="submit" value="{{ __('messages.login') }}" class="btn btn-primary btn-user btn-block">

                                    <hr>

                                    <!-- Social Logins -->
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ url('/auth/google/redirect') }}" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> {{ __('messages.login_with_google') }}
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="{{ url('/auth/github/redirect') }}" class="btn btn-github bg-dark text-white btn-user btn-block">
                                                <i class="fa-brands fa-github me-2"></i> {{ __('messages.login_with_github') }}
                                            </a>
                                        </div>
                                    </div>
                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small text-dark" href="{{ route('userRegister') }}">{{ __('messages.dont_have_account') }}</a>
                                </div>
                                <div class="text-center">
                                    <a class="small text-primary" href="{{ route('password.request') }}">{{ __('messages.forgot_password') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
<!-- Font Awesome JS (لو مش ضايفه في الـ master) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" defer></script>

<!-- Toggle Password Script -->
<script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('svg');

        if (!input || !icon) return;

        const isHidden = input.type === "password";
        input.type = isHidden ? "text" : "password";

        // بدل الكلاسات بناءً على SVG attributes (لو بتحب تغيّر الشكل)
        if (isHidden) {
            icon.setAttribute("data-icon", "eye-slash");
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            icon.setAttribute("data-icon", "eye");
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    </script>


@endsection
