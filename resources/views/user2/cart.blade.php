@extends('user2.layouts.master')

@section('content')
  <section class="cart_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>{{ __('messages.cart') }}</h2>
      </div>
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <div class="table-responsive">
        <table class="table" id="dataTable">
          <thead>
            <tr class="text-white fw-bold">
              <th scope="col">{{ __('messages.products') }}</th>
              <th scope="col">{{ __('messages.name') }}</th>
              <th scope="col">{{ __('messages.price') }}(MMK)</th>
              <th scope="col">{{ __('messages.quantity') }}</th>
              <th scope="col">{{ __('messages.total') }}(MMK)</th>
              <th scope="col">{{ __('messages.handle') }}</th>
            </tr>
          </thead>
          <tbody class="text-dark fw-bold">
            <input type="hidden" value="{{ auth()->user()->id }}" class="userId">
            @foreach ($cart as $item)
            <tr>
              <input type="hidden" value="{{ $item->product_id }}" class="productId">
              <th scope="row">
                <div class="d-flex align-items-center">
                  <img src="{{ asset('productImages/'.$item->image) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                </div>
              </th>
              <td>
                <p class="text-white mb-0 mt-4">{{ $item->name }}</p>
              </td>
              <td>
                <p class="text-white mb-0 mt-4 price">{{ $item->price }}</p>
              </td>
              <td>
                <div class="input-group quantity mt-4" style="width: 100px;">
                  <div class="input-group-btn">
                    <button class="btn btn-sm btn-minus rounded-circle bg-light border">
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
                <p class="text-white mb-0 mt-4" id="eachTotal">{{ $item->price * $item->qty }} MMK</p>
              </td>
              <td>
                <input type="hidden" id="cartId" value="{{ $item->id }}">
                <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove">
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
                <h5 class="mb-0 me-4">{{ __('messages.subtotal') }}:</h5>
                <p class="mb-0" id="subTotal">{{ $totalPrice }} MMK</p>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="mb-0 me-4">{{ __('messages.delivery_fees') }}:</h5>
                <div>
                  <p class="mb-0">500 MMK</p>
                </div>
              </div>
            </div>
            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
              <h5 class="mb-0 ps-4 me-4">{{ __('messages.total') }}:</h5>
              <p class="mb-0 pe-4" id="finalFee">{{ $totalPrice + 500 }} MMK</p>
            </div>
          </div>
          <button id="proceedCheckOut" @if(count($cart) == 0) disabled @endif class="btn border-secondary rounded-pill px-4 py-3 text-white text-uppercase mb-4 ms-4" type="button">
            {{ __('messages.payment_confirm') }}
          </button>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('js-section')
<!-- فقط jQuery في البداية -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    $('.btn-plus').click(function(){
        alert('plus clicked');
        let $parentNode = $(this).closest("tr");
        let $qtyInput = $parentNode.find('#qty');
        let qty = parseInt($qtyInput.val()) + 1;
        if(qty < 1) qty = 1;
        $qtyInput.val(qty);
        let price = parseFloat($parentNode.find(".price").text().trim()) || 0;
        $parentNode.find('#eachTotal').html( (price * qty) + ' MMK' );
        finalCalculation();
    });

    $('.btn-minus').click(function(){
        alert('minus clicked');
        let $parentNode = $(this).closest("tr");
        let $qtyInput = $parentNode.find('#qty');
        let qty = parseInt($qtyInput.val()) - 1;
        if(qty < 1) qty = 1;
        $qtyInput.val(qty);
        let price = parseFloat($parentNode.find(".price").text().trim()) || 0;
        $parentNode.find('#eachTotal').html( (price * qty) + ' MMK' );
        finalCalculation();
    });

    $(".btn-remove").click(function(){
        let $parentNode = $(this).closest("tr");
        let cartId = $parentNode.find("#cartId").val();
        $.ajax({
            type : 'get',
            url  : 'remove/cart',
            data : { cartId: cartId },
            dataType : 'json',
            success : function(response){
                if(response.message == 'success'){
                    location.reload();
                }
            }
        });
    });

    $('#proceedCheckOut').click(function(){
        let orderList = []
        let orderCode = Math.floor(Math.random() * 10000000)
        let userId = $(".userId").val() * 1;
        $("#dataTable tbody tr").each(function(){
            let productId = $(this).find('.productId').val();
            let qty = $(this).find('#qty').val() * 1;
            let price = $(this).find('.price').text().replace("MMK", "").trim() * 1;
            let totalPrice = qty * price;
            orderList.push({
                'user_id' : userId,
                'product_id' : productId,
                'order_code' : 'POS' + orderCode,
                'total_price' : totalPrice,
                'qty' : qty
            });
        });
        $.ajax({
            type: 'get',
            url : 'order',
            data : Object.assign({}, orderList),
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
        });
    });

    function finalCalculation(){
        let totalPrice = 0;
        $("#dataTable tbody tr").each(function(){
            let price = parseFloat($(this).find('.price').text().replace("MMK", "").trim()) || 0;
            let qty = parseInt($(this).find('#qty').val()) || 0;
            totalPrice += price * qty;
        });
        $("#subTotal").html(`${totalPrice} MMK`)
        $("#finalFee").html(`${totalPrice + 500} MMK`)
    }
});
</script>
@endsection
