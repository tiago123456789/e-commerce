<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $table = "carts_products";

    protected $fillable = [
        "product_id", "cart_id",
        "quantity"
    ];

    protected $hidden = [
        "created_at", "updated_at"
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

}
