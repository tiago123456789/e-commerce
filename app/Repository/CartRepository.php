<?php


namespace App\Repository;


use App\Model\Cart;

class CartRepository extends Repository
{

    public function __construct()
    {
        parent::__construct(new Cart());
    }

    public function getRelationshipLoadingEager(): array
    {
        return [];
    }
}