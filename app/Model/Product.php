<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        "description", "price", "width", "height",
        "length", "weight", "url_image", "title"
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, "products_categories");
    }

    public function products()
    {
        return $this->belongsToMany(CartProduct::class, "carts_products", "product_id", "cart_id");
    }
}
