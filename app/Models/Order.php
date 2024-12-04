<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the OrderDetail model
    public function order_details()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
