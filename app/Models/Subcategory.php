<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['name'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * Get the products for the subcategory.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
