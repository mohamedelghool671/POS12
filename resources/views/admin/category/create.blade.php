@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid"
    style="border: none !important; outline: none !important; padding: 0;"
    >
        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-lg-6 col-md-8 col-12 mx-auto"
        style="border: none !important; outline: none !important; padding: 0;">
            <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark text-center">{{ __('messages.add_category_page') }}</h6>
            </div>

            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">{{ __('messages.category_name') }}</label>
                        <input type="text" name="category" value="{{ old('category') }}"
                            class="form-control @error('category') is-invalid @enderror" id="exampleFormControlInput1"
                            placeholder="{{ __('messages.name') }}...">
                        @error('category')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <input type="submit" value="{{ __('messages.create') }}" class="btn btn-primary w-100">
                        </div>
                        <div class="col-6">
                            <a href="{{ route('category.index') }}" class="btn btn-secondary w-100">{{ __('messages.back') }}</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
