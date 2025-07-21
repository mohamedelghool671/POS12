<?php

namespace App\Services;

use App\Models\Payment;
use App\Interfaces\PaymentRepositoryInterface;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function paginate($perPage = 3)
    {
        return $this->paymentRepository->paginate($perPage);
    }

    public function find(Payment $payment)
    {
        return $this->paymentRepository->find($payment);
    }

    public function store(array $data)
    {
        return $this->paymentRepository->store($data);
    }

    public function update(Payment $payment, array $data)
    {
        return $this->paymentRepository->update($payment, $data);
    }

    public function destroy(Payment $payment)
    {
        return $this->paymentRepository->destroy($payment);
    }
}
