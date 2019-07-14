<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        "description", "price", "width", "height",
        "length", "weight", "url_image"
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, "products_categories");
    }
}
