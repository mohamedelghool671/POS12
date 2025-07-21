<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $fillable =['type','account_number','account_name'];
    public function paySlipHistory()
    {
        return $this->hasMany(PaySlipHistory::class,'payment_method_id');
    }
}
