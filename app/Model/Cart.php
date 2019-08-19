<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        "session_id", "user_id", "address_id", "freight"
    ];

    protected $hidden = [
        "created_at", "updated_at"
    ];

    public function products()
    {
        return $this->belongsToMany(CartProduct::class,
            "carts_products", "cart_id", "product_id");
    }
}
