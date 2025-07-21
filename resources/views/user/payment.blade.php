@extends('user.layouts.master')

@section('css-section')
<style>
/* ترجمة "No file chosen" باستخدام CSS */
input[type="file"]::before {
    content: "{{ __('messages.choose_file') }}";
    display: inline-block;
    background: #007bff;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 10px;
}

input[type="file"]::-webkit-file-upload-button {
    visibility: hidden;
    width: 0;
}

/* إخفاء النص الافتراضي "No file chosen" */
input[type="file"] + br + span::after {
    content: "{{ __('messages.no_file_chosen') }}";
    color: #6c757d;
}

/* إخفاء النص "No file chosen" تماماً */
input[type="file"] {
    position: relative;
}

input[type="file"]::after {
    content: "{{ __('messages.no_file_chosen') }}";
    position: absolute;
    left: 0;
    top: 100%;
    color: #6c757d;
    font-size: 14px;
    margin-top: 5px;
}

/* إخفاء النص الأصلي */
input[type="file"] + br + *:contains("No file chosen") {
    display: none !important;
}
</style>
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ __('messages.payment') }}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{route('userDashboard')}}">{{ __('messages.home') }}</a></li>
            <li class="breadcrumb-item"><a href="#">{{ __('messages.pages') }}</a></li>
            <li class="breadcrumb-item active text-white">{{ __('messages.payment') }}</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row mt-5">
                <div class="card col-10 offset-1 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <h5>{{ __('messages.transfer_to_account') }}</h5><br>
                                @foreach ($payments as $item)
                                    <div>{{ $item->type }} ( {{ __('messages.name') }}: {{ $item-> account_name }})</div>
                                    {{ __('messages.account') }}: {{ $item-> account_number }}
                                    <hr>
                                @endforeach
                            </div>
                            <div class="col">
                                <div class="container">
                                    <form action="{{ route('orderProduct')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                      <div class="row">
                                        <div class="col-25">
                                          <label for="name">{{ __('messages.your_name') }}</label>
                                        </div>
                                        <div class="col-75">
                                          <input type="text" class="payment-form" id="name" name="name">
                                          <br>
                                          @error('name')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-25">
                                          <label for="phone">{{ __('messages.phone') }}</label>
                                        </div>
                                        <div class="col-75">
                                          <input type="text" class="payment-form" id="phone" name="phone" placeholder="09xxxxxxx">
                                          <br>
                                          @error('phone')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-25">
                                          <label for="type">{{ __('messages.payment') }}</label>
                                        </div>
                                        <div class="col-75">
                                          <select id="type" name="paymentMethod" class="payment-form">
                                            <option value="">{{ __('messages.choose_payment_method') }}</option>
                                            @foreach ($payments as $item)
                                                <option value="{{$item->id}}">{{$item->type}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                          @error('paymentMethod')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-25">
                                          <label for="slip">{{ __('messages.attach_pay_slip') }}</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="file" class="payment-form" id="slip" name="paySlipImage" style="display: none;">
                                            <label for="slip" class="btn btn-primary" style="cursor: pointer; padding: 8px 16px; border-radius: 4px; background: #007bff; color: white; display: inline-block;">
                                                {{ __('messages.choose_file') }}
                                            </label>
                                            <span id="file-name" style="margin-left: 10px; color: #6c757d;">{{ __('messages.no_file_chosen') }}</span>
                                            <br>
                                          @error('paySlipImage')
                                              <small class="text-danger">{{ $message }}</small>
                                          @enderror
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-25">
                                          <label for="orderNo">{{ __('messages.order_no') }}</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="hidden" name="orderCode" value="{{ $orderProduct[0]['order_code']}}">
                                            <label for="orderNo">{{ $orderProduct[0]['order_code']}}</label>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-25">
                                          <label for="total">{{ __('messages.total') }}:</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="hidden" name="totalAmount" value="{{ $total + 500}}">
                                            <label for="total">{{ $total + 500}}</label>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <input type="submit" value="{{ __('messages.submit') }}">
                                      </div>
                                    </form>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection

@section('js-section')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // تحديث اسم الملف عند اختياره
    const fileInput = document.querySelector('input[type="file"]');
    const fileNameSpan = document.getElementById('file-name');
    const noFileText = '{{ __("messages.no_file_chosen") }}';

    if (fileInput && fileNameSpan) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameSpan.textContent = this.files[0].name;
            } else {
                fileNameSpan.textContent = noFileText;
            }
        });
    }
});
</script>
@endsection


