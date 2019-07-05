<?php


namespace App\Bo;


use App\Exceptions\LogicNegociationException;
use App\Exceptions\MessageException;
use App\Exceptions\NotFoundException;
use App\Repository\UserRepository;
use http\Message;
use Illuminate\Support\Facades\Hash;

class UserBo
{

    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function findAll(array $fieldsReturn = []) {
        return $this->repository->findAll($fieldsReturn);
    }

    public function save($newRegister) {
        $hasRegisterWithEmail = $this->repository->findByEmail($newRegister["email"]);

        if ($hasRegisterWithEmail) {
            throw new LogicNegociationException(MessageException::EMAIL_USED);
        }

        $newRegister["is_admin"] = true;
        $newRegister["password"] = Hash::make($newRegister["password"]);

        $this->repository->save($newRegister);
    }

    public function remove($id) {
        $user = $this->repository->findById($id);
        if (!$user) {
            throw new NotFoundException(MessageException::NOT_FOUND_REGISTER, ["User"]);
        }
        $this->repository->remove($id);
    }

}