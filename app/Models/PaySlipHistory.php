<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaySlipHistory extends Model
{
    use HasFactory;
    protected $fillable =['user_id','phone','payslip_image','payment_method_id','order_id','order_amount'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function paymentMethod()
    {
        return $this->belongsTo(Payment::class,'payment_method_id');
    }
}
