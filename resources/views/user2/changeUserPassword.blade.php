@extends('user2.layouts.master')

@section('content')
  <section class="changepass_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>{{ __('messages.change_password') }}</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card p-4">
            <form action="{{route ('changeUserPassword')}}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label">{{ __('messages.old_password') }}</label>
                <input type="password" name="oldPassword" value="{{old('oldPassword')}}" class="form-control @error('oldPassword') is-invalid @enderror">
                @error('oldPassword')
                  <small class="invalid-feedback">{{$message}}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">{{ __('messages.new_password') }}</label>
                <input type="password" name="newPassword" value="{{old('newPassword')}}" class="form-control @error('newPassword') is-invalid @enderror">
                @error('newPassword')
                  <small class="invalid-feedback">{{$message}}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">{{ __('messages.confirm_password') }}</label>
                <input type="password" name="confirmPassword" value="{{old('confirmPassword')}}" class="form-control @error('confirmPassword') is-invalid @enderror">
                @error('confirmPassword')
                  <small class="invalid-feedback">{{$message}}</small>
                @enderror
              </div>
              <input type="submit" value="{{ __('messages.update') }}" class="btn btn-warning w-100">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
