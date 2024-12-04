<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_image',
        'product_description',
        'price',
        'color',
        'uniqueness',
        'stock',
        'category_id',
        'subcategory_id',
    ];
    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * Get the subcategory that owns the product.
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class,);
    }
}
