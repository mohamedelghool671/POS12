@extends('user2.layouts.master')

@section('content')
  <section class="orderlist_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>{{ __('messages.order_list') }}</h2>
      </div>
      <div class="table-responsive">
        <table class="table text-center align-middle">
          <thead class="table-dark">
            <tr>
              <th>{{ __('messages.order_code') }}</th>
              <th>{{ __('messages.date') }}</th>
              <th>{{ __('messages.order_status') }}</th>
              <th>{{ __('messages.reject_reason') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $item)
              <tr>
                <td><a class="text-primary" href="{{route ('customerOrders', $item->order_code)}}">{{ $item->order_code }}</a></td>
                <td>{{ $item->created_at->format('j-F-y') }}</td>
                <td>
                  @if ($item->status == 0)
                    <span class="text-warning">{{ __('messages.pending') }}</span>
                  @elseif ($item->status == 1)
                    <span class="text-success">{{ __('messages.success') }}</span>
                  @elseif ($item->status == 2)
                    <span class="text-danger">{{ __('messages.reject') }}</span>
                  @endif
                </td>
                <td>
                  @if ($item->status == 2)
                    <span class="text-danger">{{ $item->reject_reason }}</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection
