<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $connection = 'foodgrubber_customers';
    protected $table = 'orders'; 

    protected $fillable = ['order_status'];

    public function orderItem()
    {
        return $this->hasMany(Order::class, 'order_id');
    }
}
