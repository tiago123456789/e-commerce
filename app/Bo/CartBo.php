<?php


namespace App\Bo;


use App\Exceptions\LogicNegociationException;
use App\Exceptions\MessageException;
use App\Exceptions\NotFoundException;
use App\Repository\CartRepository;

class CartBo
{

    private $repository;

    public function __construct()
    {
        $this->repository = new CartRepository();
    }

    public function save() {
        $sessionId = session_id();
        $cartCreated = $this->repository->save([ "session_id" => $sessionId ]);
        return $cartCreated;
    }
}