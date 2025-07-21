@extends('admin.layouts.master')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">{{ __('messages.add_product_page') }}</h6>
        </div>

        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <!-- العمود الأيسر للصورة والفئة -->
                    <div class="col-md-4">
                        <!-- اختيار الفئة -->
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">{{ __('messages.category_name') }}</label>
                            <select name="categoryName" id="categoryName" class="form-control @error('categoryName') is-invalid @enderror">
                                <option value="">{{ __('messages.choose_category') }}</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" @if (old('categoryName') == $item->id) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('categoryName')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- صورة المنتج -->
                        <div class="mb-3" style="position: relative;">
                            <label class="form-label">{{ __('messages.product_image') }}</label>
                            <img
                                class="img-thumbnail w-100 mb-2"
                                src="{{ asset('defaultImg/default.jpg') }}"
                                alt="product preview"
                                id="output"
                                style="height: 250px; object-fit: cover; border: 1px solid #dee2e6;"
                            >

                            <input
                                type="file"
                                name="image"
                                class="form-control @error('image') is-invalid @enderror"
                                onchange="loadFile(event)"
                                id="productImageInput"
                                style="display: none;"
                            >

                            <label
                                for="productImageInput"
                                class="btn btn-primary"
                                style="cursor: pointer; padding: 8px 16px; border-radius: 4px; background: #007bff; color: white; display: inline-block;"
                            >
                                {{ __('messages.choose_file') }}
                            </label>

                            <span
                                id="productFileName"
                                style="margin-left: 10px; color: #6c757d; display: none;"
                            >
                                {{ __('messages.no_file_chosen') }}
                            </span>

                            @error('image')
                                <small class="invalid-feedback d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- العمود الأيمن لباقي البيانات -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.name') }}</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                           placeholder="{{ __('messages.name') }}..." value="{{ old('name') }}">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.sell_price') }}</label>
                                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                                           placeholder="{{ __('messages.price') }}..." value="{{ old('price') }}">
                                    @error('price')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.purchase_price') }}</label>
                                    <input type="text" name="purchaseprice" class="form-control @error('purchaseprice') is-invalid @enderror"
                                           placeholder="{{ __('messages.purchase_price') }}..." value="{{ old('purchaseprice') }}">
                                    @error('purchaseprice')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('messages.count') }}</label>
                                    <input type="text" name="count" class="form-control @error('count') is-invalid @enderror"
                                           placeholder="{{ __('messages.count') }}..." value="{{ old('count') }}">
                                    @error('count')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.description') }}</label>
                            <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" value="{{ __('messages.create') }}" class="btn btn-primary w-100">
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('product.index') }}" class="btn btn-secondary w-100">{{ __('messages.back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.container-fluid -->
@endsection

<script>
    function loadFile(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src)
        }

        const fileName = event.target.files[0]?.name || '{{ __("messages.no_file_chosen") }}';
        const fileNameSpan = document.getElementById('productFileName');
        fileNameSpan.textContent = fileName;
        fileNameSpan.style.display = fileName !== '{{ __("messages.no_file_chosen") }}' ? 'inline' : 'none';
    }
</script>
