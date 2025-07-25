@extends('admin.layouts.master')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-dark">{{ __('messages.sale_information') }}</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center text-white">
                                    <th>{{ __('messages.product_image') }}</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.user_name') }}</th>
                                    <th>{{ __('messages.date') }}</th>
                                    <th>{{ __('messages.qty') }}</th>
                                    <th>{{ __('messages.amount') }}</th>
                                    <th>{{ __('messages.order_code') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $item)
                                    <tr class="text-center text-white">
                                        <td><img class="rounded-circle" style="width: 64px; height: 64px;" src="{{ asset('productImages/'. $item->product->image)}}" alt=""></td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->user->name ?? $item->user->nickname }}</td>
                                        <td>{{ $item->created_at->format('j-F-Y') }}</td>
                                        <td>{{ $item->count }}</td>
                                        <td>{{ $item->totalPrice }}</td>
                                        <td><a href="{{route ('order.show', $item->order_code)}}">{{ $item->order_code }} </a></td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                        {{-- <span class="d-flex justify-content-end">{{ $order->links()}}</span> --}}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
@endsection
@section('js-section')
    <script>
        $(document).ready(function(){
            $('.statusChange').change(function(){
                $currentStatus = $(this).val();
                $orderCode = $(this).parents("tr").find('.orderCode').val();

                $data ={
                    'status' : $currentStatus,
                    'orderCode' : $orderCode
                }
                // console.log($data);
                $.ajax({
                    type : 'get',
                    url : 'change/status',
                    data  : $data,
                    dataType   : 'json'
                })

            })
        })
    </script>
@endsection
