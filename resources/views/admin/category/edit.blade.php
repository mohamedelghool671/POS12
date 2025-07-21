@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid"
    style="border: none !important; outline: none !important; padding: 0;"
    >
        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-lg-6 col-md-8 col-12 mx-auto"
       style="border: none !important; outline: none !important; padding: 0;"
        >
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark text-center">
                    {{ __('messages.update_category') }}
                </h6>
            </div>

            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="categoryInput" class="form-label fw-bold">{{ __('messages.category_name') }}</label>
                        <input type="hidden" name="categoryID" value="{{ $category->id }}">
                        <input type="text" name="category" value="{{ old('category', $category->name) }}"
                            class="form-control @error('category') is-invalid @enderror" id="categoryInput"
                            placeholder="{{ __('messages.name') }}...">
                        @error('category')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row mt-4">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100">{{ __('messages.update') }}</button>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('category.index') }}" class="btn btn-secondary w-100">{{ __('messages.back') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
