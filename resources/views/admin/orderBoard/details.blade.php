@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-md-2">
            <a href="{{ route('order.index') }}" class="btn btn-secondary w-100">{{ __('messages.back') }}</a>
        </div>
            <div class="col-md-2 mt-2">
                <select class="form-control text-center font-weight-bold statusChange"
                        data-id="{{ $order->order_code }}"
                        style="background-color:rgb(223, 203, 28);">
                    <option value="0" @if ($order->status == 0) selected @endif>{{ __('messages.pending') }}</option>
                    <option value="1" @if ($order->status == 1) selected @endif>{{ __('messages.confirmed') }}</option>
                    <option value="2" @if ($order->status == 2) selected @endif>{{ __('messages.reject') }}</option>
                </select>
            </div>

        <!-- Reject Reason Modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">{{ __('messages.reject_order_reason') }}</h5>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" id="rejectNote" placeholder="{{ __('messages.enter_rejection_reason') }}"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cancelReject" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="button" class="btn btn-danger" id="confirmReject">{{ __('messages.confirm_reject') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Board -->
    <div class="row mt-4">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white text-dark">
                    <h6 class="m-0">{{ __('messages.order_items') }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>{{ __('messages.image') }}</th>
                                    <th>{{ __('messages.name') }}</th>
                                    <th>{{ __('messages.count') }}</th>
                                    <th>{{ __('messages.product_price') }}</th>
                                    <th>{{ __('messages.total_price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                      
                                        <td style="color: white"><img class="img-thumbnail" src="{{ asset('productImages/' . $order->product->image) }}" style="width: 80px;"></td>
                                        <td style="color: white">{{ $order->product->name }}</td>
                                        <td style="color: white">{{ $order->count }}</td>
                                        <td style="color: white">{{ $order->product->price }}</td>
                                        <td style="color: white">{{ $order->count * $order->product->price }}</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order & Payment Details -->
    <div class="row mt-4">
        <div class="col-lg-4 offset-1">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="font-weight-bold text-primary">{{ __('messages.order_details') }}</h6>
                    <hr>
                    <p><strong>{{ __('messages.name') }}:</strong> {{ $order->user->name }}</p>
                    <p><strong>{{ __('messages.phone') }}:</strong> {{ $order->user->phone }}</p>
                    <p><strong>{{ __('messages.order_code') }}:</strong> {{ $order->order_code }}</p>
                    <p><strong>{{ __('messages.order_date') }}:</strong> {{ $order->created_at->format('j-F-y') }}</p>
                    <p><strong>{{ __('messages.total_price') }}:</strong> {{ ($order->count * $order->product->price) + 500 }}</p>
                    <small class="text-danger">{{ __('messages.includes_delivery') }}</small>
                </div>
            </div>
        </div>

        <!-- Payment Info -->
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="font-weight-bold text-primary">{{ __('messages.payment_details') }}</h6>
                    <hr>
                    <p><strong>{{ __('messages.contact') }}:</strong> {{ $paySlipData->phone }}</p>
                    <p><strong>{{ __('messages.method') }}:</strong> {{ $paySlipData->paymentMethod->type }}</p>
                    <p><strong>{{ __('messages.image') }}:</strong>
                        <div class="text-center mt-3">
                            <a href="{{ asset('payslipRecords/' . $paySlipData->payslip_image) }}" target="_blank">
                                <img src="{{ asset('payslipRecords/' . $paySlipData->payslip_image) }}" class="img-thumbnail" style="max-width: 70px; cursor: pointer;">
                            </a>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-section')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let previousStatus = {};
let currentRejectSelect = null;
let currentRejectId = null;

$('.statusChange').on('focus', function () {
    previousStatus[$(this).data('id')] = $(this).val();
});

$('.statusChange').on('change', function () {
    let status = $(this).val();
    let orderId = $(this).data('id');
    let that = this;

    if (status == 2) {
        $(that).val(previousStatus[orderId]); // رجع القيمة القديمة مؤقتًا
        currentRejectSelect = that;
        currentRejectId = orderId;
        $('#rejectModal').modal('show');
        return;
    }

    Swal.fire({
        title: '{{ __("messages.are_you_sure") }}',
        text: "{{ __('messages.you_are_about_to_change_order_status') }}",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '{{ __("messages.yes_do_it") }}',
        cancelButtonText: '{{ __("messages.cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/admin/order/removereject', {
                _token: "{{ csrf_token() }}",
                order_code: orderId,
                status: status
            }).done(() => {
                Swal.fire('{{ __("messages.success") }}!', '{{ __("messages.order_status_updated") }}', 'success');
                previousStatus[orderId] = status;
            }).fail(() => {
                Swal.fire('{{ __("messages.error") }}!', '{{ __("messages.something_went_wrong") }}', 'error');
            });
        } else {
            $(that).val(previousStatus[orderId]);
        }
    });
});

$('#confirmReject').on('click', function () {
    let reason = $('#rejectNote').val();
    if (!reason.trim()) {
        Swal.fire('{{ __("messages.error") }}!', '{{ __("messages.please_provide_rejection_reason") }}', 'error');
        return;
    }

    $.post('/admin/order/reject', {
        _token: "{{ csrf_token() }}",
        order_code: currentRejectId,
        reason: reason
    }).done(() => {
        Swal.fire('{{ __("messages.rejected") }}!', '{{ __("messages.order_rejected_successfully") }}', 'success');
        $('#rejectModal').modal('hide');
        $(currentRejectSelect).val(2);
        previousStatus[currentRejectId] = 2;
        currentRejectSelect = null;
        currentRejectId = null;
    }).fail(() => {
        Swal.fire('{{ __("messages.error") }}!', '{{ __("messages.something_went_wrong") }}', 'error');
    });
});

// زرار Close أو X
$('#cancelReject, #modalCloseBtn').on('click', function () {
    $('#rejectModal').modal('hide');
    currentRejectSelect = null;
    currentRejectId = null;
});
</script>
@endsection
