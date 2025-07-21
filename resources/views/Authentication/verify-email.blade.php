@extends('Authentication.layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-12 col-md-9 mt-5">
            <div class="card o-hidden border-0 my-5 loginform">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-10 offset-1">
                            <div class="p-5 text-center">
                                <h1 class="mb-4">{{ __('messages.verify_email') }}</h1>
                                <p>{{ __('messages.verification_link_sent') }}</p>
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">{{ __('messages.resend_verification_link') }}</button>
                                </form>
                                @if (session('status'))
                                    <div class="alert alert-success mt-3">{{ session('status') }}</div>
                                @endif
                                <div class="text-center mt-3">
                                    <a class="small text-dark" href="{{ route('logout') }}">{{ __('messages.logout') }}</a>
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
