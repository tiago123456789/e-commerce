<?php


namespace App\Repository;


use App\Model\User;

class UserRepository extends Repository
{

    public function __construct()
    {
        parent::__construct(new User());
    }

    public function findByEmail($email) {
        return $this->getModel()->where("email", $email)->first();
    }

    public function getRelationshipLoadingEager(): array
    {
        return [];
    }
}