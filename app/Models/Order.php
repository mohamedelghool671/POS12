<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','user_id','status','reject_reason','order_code','count','totalPrice'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function paySlipHistory()
    {
        return $this->hasMany(PaySlipHistory::class,'order_id');
    }
}
