@extends('admin.layouts.master')

@section('content')
     <div class="container-fluid">
        <div class="card shadow mb-4 col-5 offset-3">
            <div class="card-header py-3">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-dark">{{ __('messages.change_password') }}...</h6>
                    </div>
            </div>
            <div class="card-body">
                <form action="{{route ('admin.changePassword')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label ">{{ __('messages.old_password') }}</label>
                        <input type="password" name="oldPassword" value="{{old('oldPassword')}}" class="form-control @error('oldPassword') is-invalid @enderror" id="exampleFormControlInput1" >
                        @error('oldPassword')
                            <small class="invalid-feedback">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label ">{{ __('messages.new_password') }}</label>
                        <input type="password" name="newPassword" value="{{old('newPassword')}}" class="form-control @error('newPassword') is-invalid @enderror" id="exampleFormControlInput1" >
                        @error('newPassword')
                            <small class="invalid-feedback">{{$message}}</small>
                        @enderror
                    </div>                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label ">{{ __('messages.confirm_password') }}</label>
                        <input type="password" name="confirmPassword" value="{{old('confirmPassword')}}" class="form-control @error('confirmPassword') is-invalid @enderror" id="exampleFormControlInput1">
                        @error('confirmPassword')
                            <small class="invalid-feedback">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <input type="submit" value="{{ __('messages.update') }}" class="btn btn-primary w-100">
                        </div>
                        <div class="col">
                            <a href="{{ route('adminDashboard') }}" class="btn btn-secondary w-100 text-center"
                                            >{{ __('messages.back') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
