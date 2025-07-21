@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-dark">
                            <form action="{{ route('product.index') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" name="searchKey" class="form-control "
                                        placeholder="{{ __('messages.search_products') }}" value="{{request('searchKey')}}">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </h6>
                    </div>
                    <div class="font-weight-bold">
                        <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> {{ __('messages.add_product') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body" >
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center text-white">
                                <th>{{ __('messages.product_name') }}</th>
                                <th>{{ __('messages.image') }}</th>
                                <th>{{ __('messages.price') }}</th>
                                <th>{{ __('messages.stock') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr class="text-center text-white">
                                    <td>{{ $item->name }}</td>
                                    <td >
                                        <img class="rounded-circle" style="width: 64px; height: 64px;" src="{{ asset('productImages/' . $item->image) }}" alt="">
                                    </td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->count }}</td>
                                    <td style="width: 200px;">
                                        <a href="{{ route('product.show', $item) }}"><i class="fa-solid fa-eye btn btn-primary"></i></a>
                                        <a href="{{ route('product.edit', $item) }}"><i class="fa-solid fa-pen-to-square btn btn-secondary"></i></a>
                                        <form action="{{ route('product.destroy', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger p-2 delete" style="box-shadow:none; background: #dc3545; border:none;">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">{{ $products->links() }}</span>
                </div>
            </div>
        </div>

    </div>
@endsection




