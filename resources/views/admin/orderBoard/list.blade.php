@extends('admin.layouts.master')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">
           <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-dark">{{ __('messages.order_board') }}</h6>
                        </div>

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                                            <tr class="text-center text-white">
                                <th >{{ __('messages.date') }}</th>
                                <th >{{ __('messages.customer_name') }}</th>
                                <th class="text-center text-warning fw-bolder">{{ __('messages.order_state') }}</th>
                                <th >{{ __('messages.order_details') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)

                                <tr class="text-center text-white">
                                <input type="hidden" class="orderCode text-center" value="{{ $item->order_code }}">
                                 <th >{{ $item->created_at->format('j-F-y') }}</th>
                                 <th><a href="{{route ('accountProfile', $item->user_id)}}">{{ $item->user?->name ?? $item->user?->nickname  }}</a></th>
                                    <th class="text-center">
                                        @if ($item->status == 0)
                                            {{ __('messages.pending') }}
                                        @elseif ($item->status == 1)
                                            {{ __('messages.accept') }}
                                        @elseif ($item->status == 2)
                                            {{ __('messages.refund_reject') }}
                                        @endif
                                    </th>
                                    <td>
                                        <a href="{{ route('order.show', $item->order_code) }}" class="btn btn-primary p-2" title="{{ __('messages.details') }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>

                             </tr>
                                @endforeach

                            </tbody>

                        </table>
                        <span class="d-flex justify-content-end">{{ $orders->links()}}</span>
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
