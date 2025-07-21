<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

        protected $fillable = [
            'name',
            'email',
            'password',
            'phone',
            'address',
            'profile',
            'role',
            'nickname',
            'provider',
            'provider_id',
            'provider_token',
            'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function order() {
        return $this->hasMany(Order::class,'user_id');
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function paySlipHistory() {
        return $this->hasMany(PaySlipHistory::class,'user_id');
    }
    public function reports() {
        return $this->hasMany(Report::class, 'user_id');
    }
    public function ratings() {
        return $this->hasMany(Rating::class, 'user_id');
    }
    public function carts() {
        return $this->hasMany(Cart::class, 'user_id');
    }
}
