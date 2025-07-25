@extends('user.layouts.master')
@section('content')
<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->


<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Your Order</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{route ('userDashboard')}}">Home</a></li>

    </ol>
</div>
<!-- Single Page Header End -->
        <!-- Begin Page Content -->
        <div class="container-fluid py-1">
                <div class="card-body">
                    <a href="{{ route('orderList')}}" class="text-white fw-bold"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                    <div class="table-responsive">
                        <table class="text-white text-center table table-bordered mt-3" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.image') }}</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.count') }}</th>
                                    <th>{{ __('messages.product_price') }}</th>
                                    <th>{{ __('messages.total_price') }}</th>
                                    @if(isset($orders[0]) && isset($orders[0]->status) && $orders[0]->status == 2 && isset($orders[0]->reject_reason))
                                        <th>{{ __('messages.reject_reason') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                <tr>
                                    <td class="col-2"><img class="img-thumbnail rounded-circle" style="width: 80px; height: 80px;"
                                        src="{{ asset('productImages/' . $item->product->image) }}" alt=""></td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->count }}</td>
                                    <td>{{ $item->product->price}}</td>
                                    <td>{{ $item->count * $item->product->price}}</td>
                                    @if(isset($item->status) && $item->status == 2 && isset($item->reject_reason))
                                        <td>{{ $item->reject_reason }}</td>
                                    @endif
                                </tr>
                                @endforeach

                            </tbody>

                        </table>

                        <span class="d-flex justify-content-end">{{ $orders->links()}}</span>
                    </div>
                </div>
            </div>


        <!-- /.container-fluid -->
@endsection
