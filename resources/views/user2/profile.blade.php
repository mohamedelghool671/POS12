@extends('user2.layouts.master')

@section('content')
  <section class="profile_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>{{ __('messages.your_profile') }}</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card p-4">
            <form action="{{ route('profileUpdate') }}" method="post" enctype="multipart/form-data" id="profileForm">
              @csrf
              <div class="row mb-3">
                <div class="col-md-4 text-center">
                  <input type="hidden" name="oldImage" value="{{ auth()->user()->profile }}">
                  @if (auth()->user()->profile == null)
                    <img class="img-profile img-thumbnail" id="output" src="{{ asset('admin/img/undraw_profile.svg') }}" style="width: 150px;">
                  @else
                    <img class="img-profile img-thumbnail" id="output" src="{{ asset('userProfile/'. auth()->user()->profile) }}?v={{ time() }}" style="width: 150px;">
                  @endif
                  <input type="file" name="image" class="form-control mt-2 @error('image') is-invalid @enderror" onchange="loadFile(event)">
                  @error('image')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="col-md-8">
                  <div class="mb-3">
                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="{{ __('messages.name_placeholder') }}" value="{{ old('name', auth()->user()->name ?? auth()->user()->nickname) }}">
                    @error('name')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">{{ __('messages.email') }}</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{ __('messages.email_placeholder') }}" value="{{ old('email', auth()->user()->email) }}">
                    @error('email')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="{{ __('messages.phone_placeholder') }}" value="{{ old('phone', auth()->user()->phone) }}">
                    @error('phone')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="address" class="form-label">{{ __('messages.address') }}</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="{{ __('messages.address_placeholder') }}" value="{{ old('address', auth()->user()->address) }}">
                    @error('address')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  @if (auth()->user()->provider == 'simple')
                    <a class="text-info fw-bold" href="{{ route('changePassword') }}">{{ __('messages.change_password') }}</a><br><br>
                  @endif
                  <input type="submit" value="{{ __('messages.update') }}" class="btn btn-warning w-100 mt-2">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
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
