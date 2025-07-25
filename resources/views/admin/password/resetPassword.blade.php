@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-lg-6 col-md-8 col-12 mx-auto">
            <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark text-center">{{ __('messages.reset_password_page') }}</h6>
            </div>

            <form action="{{ route('resetPassword') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" id="exampleFormControlInput1"
                            placeholder="{{ __('messages.enter_email_to_reset') }}">
                        @error('email')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <input type="submit" value="{{ __('messages.reset_password') }}" class="btn btn-primary w-100">
                        </div>
                        <div class="col-6">
                            <a href="{{ route('adminDashboard') }}" class="btn btn-secondary w-100 text-center">{{ __('messages.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
