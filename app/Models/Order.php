<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_time',
        'total_price',
        'total_qty',
        'id_cashier',
        'payment_method'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_cashier', 'id');
    }
}
