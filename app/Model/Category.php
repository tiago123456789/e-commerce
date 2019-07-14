<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ["description"];

    public function products() {
        return $this->belongsToMany(Product::class, "products_categories");
    }
}
