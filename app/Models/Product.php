<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','category_id','description','count','image','purchase_price'];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function comments() {
        return $this->hasMany(Comment::class,'product_id');
    }
    public function orders() {
        return $this->hasMany(Order::class,'product_id');
    }
    public function discounts() {
        return $this->hasMany(Discount::class, 'product_id');
    }
    public function ratings() {
        return $this->hasMany(Rating::class, 'product_id');
    }
    public function carts() {
        return $this->hasMany(Cart::class, 'product_id');
    }
}
