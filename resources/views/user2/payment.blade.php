@extends('user2.layouts.master')

@section('content')
  @include('sweetalert::alert')
  <section class="payment_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>{{ __('messages.payment') }}</h2>
      </div>
      <div class="row mt-5">
        <div class="col-md-6">
          <div class="card p-3">
            <h5>{{ __('messages.transfer_to_account') }}</h5>
            <hr>
            @foreach ($payments as $item)
              <div>{{ $item->type }} ({{ __('messages.name') }}: {{ $item->account_name }})</div>
              <div>{{ __('messages.account') }}: {{ $item->account_number }}</div>
              <hr>
            @endforeach
          </div>
        </div>
        <div class="col-md-6">
          <div class="card p-3">
            <form action="{{ route('orderProduct')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="name">{{ __('messages.your_name') }}</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="phone">{{ __('messages.phone') }}</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="09xxxxxxx">
                @error('phone')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="type">{{ __('messages.payment') }}</label>
                <select id="type" name="paymentMethod" class="form-control">
                  <option value="">{{ __('messages.choose_payment_method') }}</option>
                  @foreach ($payments as $item)
                    <option value="{{$item->id}}">{{$item->type}}</option>
                  @endforeach
                </select>
                @error('paymentMethod')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="slip">{{ __('messages.attach_pay_slip') }}</label><br>
                <label for="slip" class="btn btn-primary" style="cursor:pointer;">
                  {{ __('messages.choose_file') }}
                </label>
                <input type="file" class="d-none" id="slip" name="paySlipImage" onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : '{{ __('messages.no_file_chosen') }}';">
                <span id="file-name" class="ms-2 text-muted">{{ __('messages.no_file_chosen') }}</span>
                @error('paySlipImage')
                  <br><small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="mb-3">
                <label for="orderNo">{{ __('messages.order_no') }}</label>
                @if(isset($orderProduct) && is_array($orderProduct) && count($orderProduct) > 0 && isset($orderProduct[0]['order_code']))
                  <input type="hidden" name="orderCode" value="{{ $orderProduct[0]['order_code']}}">
                  <input type="text" class="form-control fw-bold text-primary" value="{{ $orderProduct[0]['order_code']}}" disabled>
                @else
                  <input type="text" class="form-control" value="{{ __('messages.not_enough_data') }}" disabled>
                @endif
              </div>
              <div class="mb-3">
                <label for="total">{{ __('messages.total') }}:</label>
                <input type="hidden" name="totalAmount" value="{{ $total + 500}}">
                <input type="text" class="form-control" value="{{ $total + 500}}" disabled>
              </div>
              <div class="mb-3">
                <input type="submit" value="{{ __('messages.submit') }}" class="btn btn-warning w-100">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('js-section')
<script>
// لا حاجة لجافاسكريبت إضافي لأن onchange في input بيحدث اسم الملف تلقائياً
</script>
@endsection
