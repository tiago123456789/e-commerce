<?php


namespace App\Bo;


use App\Repository\CartProductRepository;
use App\Repository\CartRepository;
use Illuminate\Support\Facades\Session;

class CartBo
{

    private $repository;

    private $cartProductRepository;

    public function __construct()
    {
        $this->repository = new CartRepository();
        $this->cartProductRepository = new CartProductRepository();
    }

    public function save() {
        $sessionId = Session::getId();
        $cartCreated = $this->repository->save([ "session_id" => $sessionId ]);
        return $cartCreated;
    }

    public function addProduct($idProduct, $quantity)
    {
        $idCart = Session::get("cart_id");
        $this->cartProductRepository->save([
            "cart_id" => $idCart,
            "product_id" => $idProduct,
            "quantity" => $quantity
        ]);
    }

    public function removeProduct($idProduct)
    {
        $idCart = Session::get("cart_id");
        $this->cartProductRepository->removeProduct($idCart, $idProduct);
    }

    public function decrementQuantityProduct()
    {
        $idCart = Session::get("cart_id");
        $cardProduct = $this->cartProductRepository->findByCart($idCart);

    }

    public function incrementQuantityProduct()
    {

    }
}