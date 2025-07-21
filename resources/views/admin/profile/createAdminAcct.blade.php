@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Navigation Buttons -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('role.index') }}" class="btn btn-primary gap-3" style="margin-right: 30px;">
                        <i class="fas fa-user-shield me-2"></i>{{ __('messages.admin_list') }}
                    </a>
                    <a href="{{ route('role.userList') }}" class="btn btn-primary">
                        <i class="fas fa-users me-2"></i>{{ __('messages.customer_list') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-5 offset-3">
            <div class="card-header py-3 justify-content-center">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-dark">{{ __('messages.add_admin_account') }}</h6>
                </div>

            </div>
            <div class="card-body">
                <form action="{{ route('createAdmin') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('messages.name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" id="name">
                        @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('messages.email') }}</label>
                        <input type="text" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" id="email">
                        @error('email')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('messages.password') }}</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password">
                        @error('password')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmpassword" class="form-label">{{ __('messages.confirm_password') }}</label>
                        <input type="password" name="confirmpassword"
                            class="form-control @error('confirmpassword') is-invalid @enderror" id="confirmpassword">
                        @error('confirmpassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" value="{{ __('messages.create') }}" class="btn btn-primary w-100">
                        </div>
                        <div class="col">
                            <a href="{{ route('adminDashboard')}}" class="btn btn-secondary w-100">{{ __('messages.cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
