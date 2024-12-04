<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    protected $table = 'revenue';

    protected $fillable = [
        'user_name',
        'product_name',
        'quantity',
        'price',
        'total_price',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
