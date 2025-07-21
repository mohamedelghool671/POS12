@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-dark">
                            {{ __('messages.update_your_product') }}
                        </h6>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('product.update', $products->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="oldImage" value="{{$products->image}}">
                    <input type="hidden" name="productID" value="{{$products->id}}">

                    <div class="row">
                        <!-- العمود الأيسر - الفئة والصورة -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">{{ __('messages.category_name') }}</label>
                                <select name="categoryName" id="categoryName" class="form-control @error('categoryName') is-invalid @enderror">
                                    <option value="">{{ __('messages.choose_category') }}</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" @if (old('categoryName',$products->category_id) == $item->id)selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('categoryName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- صورة المنتج -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.product_image') }}</label>
                                <img class="img-thumbnail w-100 mb-2" src="{{ asset('productImages/'. $products->image) }}" alt="" id="output" style="height: 250px; object-fit: cover;">
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" onchange="loadFile(event)" id="productImageInput" style="display: none;">
                                <label for="productImageInput" class="btn btn-primary" style="cursor: pointer; padding: 8px 16px; border-radius: 4px; background: #007bff; color: white; display: inline-block;">
                                    {{ __('messages.choose_file') }}
                                </label>
                                <span id="productFileName" style="margin-left: 10px; color: #6c757d; display: none;">{{ __('messages.no_file_chosen') }}</span>
                                @error('image')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- العمود الأيمن - تفاصيل المنتج -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="productName" class="form-label">{{ __('messages.name') }}</label>
                                        <input type="text" name="name" id="productName"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('messages.name') }}..." value="{{old('name',$products->name)}}">
                                        @error('name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sellPrice" class="form-label">{{ __('messages.sell_price') }}</label>
                                        <input type="text" name="price" id="sellPrice"
                                            class="form-control @error('price') is-invalid @enderror"
                                            placeholder="{{ __('messages.price') }}..." value="{{old('price',$products->price)}}">
                                        @error('price')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="purchasePrice" class="form-label">{{ __('messages.purchase_price') }}</label>
                                        <input type="text" name="purchaseprice" id="purchasePrice"
                                            class="form-control @error('purchase_price') is-invalid @enderror"
                                            placeholder="{{ __('messages.purchase_price') }}..." value="{{old('purchase_price',$products->purchase_price)}}">
                                        @error('purchase_price')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="productCount" class="form-label">{{ __('messages.count') }}</label>
                                        <input type="text" name="count" id="productCount"
                                            class="form-control @error('count') is-invalid @enderror"
                                            placeholder="{{ __('messages.count') }}..." value="{{old('count',$products->count)}}">
                                        @error('count')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label">{{ __('messages.description') }}</label>
                                <textarea name="description" id="productDescription" rows="5"
                                    class="form-control @error('description') is-invalid @enderror">{{old('description',$products->description)}}</textarea>
                                @error('description')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- أزرار التحكم -->
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="submit" value="{{ __('messages.update') }}" class="btn btn-primary w-100">
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('product.index') }}" class="btn btn-secondary w-100 text-center">{{ __('messages.back') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

<script>
    function loadFile(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }

        // تحديث اسم الملف
        var fileName = event.target.files[0] ? event.target.files[0].name : '{{ __("messages.no_file_chosen") }}';
        document.getElementById('productFileName').textContent = fileName;

        // إخفاء النص إذا تم اختيار ملف
        if (event.target.files[0]) {
            document.getElementById('productFileName').style.display = 'none';
        } else {
            document.getElementById('productFileName').style.display = 'inline';
        }
    }
</script>


