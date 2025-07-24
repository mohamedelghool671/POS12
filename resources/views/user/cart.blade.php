@extends('user.layouts.master')
@include('sweetalert::alert')
@section('content')
 <!-- Single Page Header start -->
 <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ __('messages.cart') }}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{route('userDashboard')}}">{{ __('messages.home') }}</a></li>
            <li class="breadcrumb-item "><a href="#">{{ __('messages.shop') }}</a></li>
            <li class="breadcrumb-item active text-white">{{ __('messages.cart') }}</li>
        </ol>
    </div>
<!-- Single Page Header End -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <!-- Cart Page Start -->
    <div class="container-fluid py-1">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                      <tr class="text-white fw-bold">
                        <th scope="col">{{ __('messages.products') }}</th>
                        <th scope="col">{{ __('messages.name') }}</th>
                        <th scope="col">{{ __('messages.price') }}()</th>
                        <th scope="col">{{ __('messages.quantity') }}</th>
                        <th scope="col">{{ __('messages.total') }}()</th>
                        <th scope="col">{{ __('messages.handle') }}</th>
                      </tr>
                    </thead>
                    <tbody class="text-dark fw-bold">
                        <input type="hidden" name="" value="{{ auth()->user()->id }}" class="userId">
                        @foreach ($cart as $item)
                        <tr>
                            <input type="hidden" name="" value="{{ $item->product_id }}" class="productId">
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('productImages/'.$item->product->image)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="text-white mb-0 mt-4">{{ $item->product->name }}</p>
                            </td>
                            <td>
                                <p class="text-white mb-0 mt-4" id="price">{{ $item->product->price }}</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" id="qty" value="{{ $item->qty }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-white mb-0 mt-4" id="eachTotal">{{ $item->price * $item ->qty }}</p>
                            </td>
                            <td>
                                <input type="hidden" class="cartId" value="{{ $item->id}}">
                                <button class="btn btn-md  rounded-circle bg-light border mt-4 btn-remove" >
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">{{ __('messages.cart') }} <span class="fw-normal">{{ __('messages.total') }}</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4" >{{ __('messages.subtotal') }}:</h5>
                                <p class="mb-0" id="subTotal">{{ $totalPrice }} </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">{{ __('messages.delivery_fees') }}:</h5>
                                <div class="">
                                    <p class="mb-0">500 </p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4" >{{ __('messages.total') }}:</h5>
                            <p class="mb-0 pe-4" id="finalFee">{{ $totalPrice + 500 }} </p>
                        </div>
                    </div>
                        <button id="proceedCheckOut" @if (count($cart)== 0) disabled @endif
                        class="btn border-secondary rounded-pill px-4 py-3 text-white text-uppercase mb-4 ms-4"
                        type="button">{{ __('messages.payment_confirm') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-section')
    <script>
        // حساب الإجمالي لكل منتج عند أول تحميل
$("#dataTable tbody tr").each(function(index, row){
    let price = parseFloat($(row).find("#price").text());
    let qty = parseInt($(row).find("#qty").val());
    let total = price * qty;
    $(row).find("#eachTotal").html(total);
});

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            // حل مشكلة زيادة/نقصان الكمية مرتين
            $('.btn-plus').off('click').on('click', function(){
                $parentNode = $(this).parents("tr");
                $qtyInput = $parentNode.find('#qty');
                let qty = parseInt($qtyInput.val());
                $qtyInput.val(qty + 1);
                $price = $parentNode.find("#price").text().replace("","");
                $qty = $parentNode.find('#qty').val();
                $totalPrice = $qty * $price;
                $parentNode.find('#eachTotal').html( $totalPrice + '' );
                finalCalculation();
            });
            $('.btn-minus').off('click').on('click', function(){
                $parentNode = $(this).parents("tr");
                $qtyInput = $parentNode.find('#qty');
                let qty = parseInt($qtyInput.val());
                if(qty > 1) {
                    $qtyInput.val(qty - 1);
                }
                $price = $parentNode.find("#price").text().replace("","");
                $qty = $parentNode.find('#qty').val();
                $totalPrice = $qty * $price;
                $parentNode.find('#eachTotal').html( $totalPrice + '' );
                finalCalculation();
            });
            //when btn remove click
             $(".btn-remove").click(function(){
            let $parentNode = $(this).closest("tr");
            let cartId = $parentNode.find(".cartId").val();

            $.ajax({
                type: 'POST',
                url: '/user/remove/cart',
                data: {
                    _method: 'DELETE', 
                    cartId: cartId
                },
                dataType: 'json',
                success: function(response){
                    if(response.message === 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: '{{ __("messages.delete_success") }}',
                            text: '{{ __("messages.product_removed_from_cart") }}',
                            confirmButtonText: '{{ __("messages.sweet_ok") }}',
                            timer: 1500,
                            showConfirmButton: true
                        });
                        setTimeout(function(){ location.reload(); }, 1500);
                    }
                },
                error: function(xhr){
                    let alertData = xhr.responseJSON && xhr.responseJSON.alert ? xhr.responseJSON.alert : null;
                    if(alertData){
                        Swal.fire({
                            icon: alertData.icon,
                            title: alertData.title,
                            text: alertData.text,
                            confirmButtonText: '{{ __("messages.sweet_ok") }}',
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: '{{ __("messages.delete_failed") }}',
                            text: '{{ __("messages.delete_failed_message") }}',
                            confirmButtonText: '{{ __("messages.sweet_ok") }}',
                        });
                    }
                }
            });
        });
        //order process
        $('#proceedCheckOut').click(function(){
            $orderList =[]
            $orderCode = Math.floor(Math.random() * 10000000)//random value
            $userId = $(".userId").val() * 1;
            $(" #dataTable tbody tr ").each(function( item, row){
                    $productId = $(row).find('.productId').val();
                    $qty = $(row).find('#qty').val() * 1;
                    $totalPrice = $(row).find('#eachTotal').text().replace("", "") * 1;
                    $orderList.push({
                        'user_id' :$userId,
                        'product_id' : $productId,
                        'order_code' : 'POS' + $orderCode,
                        'total_price' : $totalPrice,
                        'qty' : $qty
                    })
            })
             $.ajax({
                type: 'get',
                url : 'order',
                data : Object.assign({},$orderList),
                dataType : 'json',
                success : function(response){
                    if(response.message == 'success' || response.status == 200){
                        location.href = "userPayment"
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '{{ app()->getLocale() == "ar" ? "فشل الطلب" : "Order Failed" }}',
                            text: '{{ app()->getLocale() == "ar" ? "حدث خطأ أثناء إرسال الطلب" : "An error occurred while sending the order" }}',
                        });
                    }
                },
                error: function(){
                    Swal.fire({
                        icon: 'error',
                        title: '{{ app()->getLocale() == "ar" ? "فشل الطلب" : "Order Failed" }}',
                        text: '{{ app()->getLocale() == "ar" ? "حدث خطأ أثناء إرسال الطلب" : "An error occurred while sending the order" }}',
                    });
                }
             })
        })
        // حل مشكلة عدم ظهور الإجمالي عند أول تحميل
        finalCalculation();
        function finalCalculation(){
            let $totalPrice = 0;
            $("#dataTable tbody tr").each(function(item, row){
                let val = Number($(row).find("#eachTotal").text().trim());
                if (!isNaN(val) && val !== null && val !== '') $totalPrice += val;
            });
            $("#subTotal").html(`${$totalPrice}  `)
            $("#finalFee").html(`${$totalPrice+500} `)
        }
        })
    </script>
@endsection
