<?php

namespace App\Http\Controllers;

use App\Bo\CartBo;

class CartController extends Controller
{

    private $bo;

    public function __construct(CartBo $bo)
    {
        $this->bo = $bo;
    }

}