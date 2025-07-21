<?php

namespace App\Interfaces;

use App\Models\Payment;

interface PaymentRepositoryInterface
{
    public function paginate($perPage = 3);
    public function find(Payment $payment);
    public function store(array $data);
    public function update(Payment $payment, array $data);
    public function destroy(Payment $payment);
}
