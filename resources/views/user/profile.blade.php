@extends('user.layouts.master')

@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">{{ __('messages.your_profile') }}</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{route('userDashboard')}}">{{ __('messages.home') }}</a></li>
        <li class="breadcrumb-item"><a href="#">{{ __('messages.pages') }}</a></li>
        <li class="breadcrumb-item active text-white">{{ __('messages.profile') }}</li>
    </ol>
</div>
<!-- Single Page Header End -->

<div class="container-fluid profile py-1">
    <div class="card-header col-8 offset-2 py-3" style="background-color: #f1f1f1;">
        <div class="mt-1">
            <div class="">
                <h4 class="font-weight-bold text-secondary">
                    {{ __('messages.user_profile') }}
                </h4>
            </div>
        </div>

        <form action="{{ route('profileUpdate') }}" method="post" enctype="multipart/form-data" id="profileForm">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <input type="hidden" name="oldImage" value="{{ auth()->user()->profile }}">
                        @if (auth()->user()->profile == null)
                            <img class="img-profile img-thumbnail" id="output" src="{{ asset('admin/img/undraw_profile.svg') }}" style="width: 200px;">
                        @else
                            <img class="img-profile img-thumbnail" id="output" src="{{ asset('userProfile/'. auth()->user()->profile) }}?v={{ time() }}" style="width: 200px;">
                        @endif

                        <input type="file" name="image"
                            class="form-control mt-1 @error('image') is-invalid @enderror"
                            onchange="loadFile(event)">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name" placeholder="{{ __('messages.name_placeholder') }}"
                                        value="{{ old('name', auth()->user()->name ?? auth()->user()->nickname) }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('messages.email') }}</label>
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email" placeholder="{{ __('messages.email_placeholder') }}"
                                        value="{{ old('email', auth()->user()->email) }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" placeholder="{{ __('messages.phone_placeholder') }}"
                                        value="{{ old('phone', auth()->user()->phone) }}">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="address" class="form-label">{{ __('messages.address') }}</label>
                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        id="address" placeholder="{{ __('messages.address_placeholder') }}"
                                        value="{{ old('address', auth()->user()->address) }}">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if (auth()->user()->provider == 'simple')
                            <a class="text-info fw-bold" href="{{ route('changePassword') }}">{{ __('messages.change_password') }}</a><br><br>
                        @endif

                        <div class="row">
                            <div class="col">
                                <input type="submit" value="{{ __('messages.update') }}" class="btn btn-warning w-100 mt-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function loadFile(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src);
        }
    }
</script>
@endsection
