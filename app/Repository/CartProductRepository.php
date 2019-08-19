<?php


namespace App\Repository;


use App\Model\CartProduct;

class CartProductRepository extends Repository
{

    public function __construct()
    {
        parent::__construct(new CartProduct());
    }

    public function findByCart($idCart)
    {
        return $this->getModel()->where("cart_id", $idCart)->first();
    }

    public function removeProduct($idCart, $idProduct)
    {
        $cartProduct = $this->getModel()
                                ->where("cart_id", $idCart)
                                ->where("product_id", $idProduct)
                                ->first();

        $cartProduct->destroy();
    }

    public function getRelationshipLoadingEager(): array
    {
        return [];
    }
}