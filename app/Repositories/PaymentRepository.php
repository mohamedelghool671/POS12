<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Interfaces\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function paginate($perPage = 3)
    {
        return Payment::paginate($perPage);
    }

    public function find(Payment $payment)
    {
        return $payment;
    }

    public function store(array $data)
    {
        return Payment::create($data);
    }

    public function update(Payment $payment, array $data)
    {
        $payment->update($data);
        return $payment;
    }

    public function destroy(Payment $payment)
    {
        return $payment->delete();
    }
}
