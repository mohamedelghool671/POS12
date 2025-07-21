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
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="{{ __('messages.enter_your_email') }}" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <input type="submit" value="{{ __('messages.send_reset_link') }}" class="btn btn-primary btn-user btn-block">
                                </form>
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
@endsection
