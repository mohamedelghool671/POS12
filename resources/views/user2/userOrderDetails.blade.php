@extends('user2.layouts.master')

@section('content')
  <section class="orderdetails_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>{{ __('messages.your_order') }}</h2>
      </div>
      <div class="table-responsive">
        <table class="table text-center align-middle table-bordered">
          <thead class="table-dark">
            <tr>
              <th>{{ __('messages.image') }}</th>
              <th>{{ __('messages.name') }}</th>
              <th>{{ __('messages.count') }}</th>
              <th>{{ __('messages.product_price') }}</th>
              <th>{{ __('messages.total_price') }}</th>
              @if(isset($order[0]) && isset($order[0]->status) && $order[0]->status == 2 && isset($order[0]->reject_reason))
                <th>{{ __('messages.reject_reason') }}</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($order as $item)
              <tr>
                <td><img class="img-thumbnail" src="{{ asset('productImages/' . $item->productimage) }}" style="width:60px;height:60px;" alt=""></td>
                <td>{{ $item->productname }}</td>
                <td>{{ $item->ordercount }}</td>
                <td>{{ $item->productprice}}</td>
                <td>{{ $item->ordercount * $item->productprice}}</td>
                @if(isset($item->status) && $item->status == 2 && isset($item->reject_reason))
                  <td>{{ $item->reject_reason }}</td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-end">
          {{ $order->links() }}
        </div>
        <a href="{{ route('orderList')}}" class="btn btn-outline-primary mt-3"><i class="fa fa-arrow-left"></i> {{ __('messages.back') }}</a>
      </div>
    </div>
  </section>
@endsection
