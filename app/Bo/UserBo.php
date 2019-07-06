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

    public function findById($id) {
        $user = $this->repository->findById($id);
        if (!$user) {
            throw new NotFoundException(MessageException::NOT_FOUND_REGISTER, ["User"]);
        }

        return $user;
    }

    public function remove($id) {
        $this->findById($id);
        $this->repository->remove($id);
    }

    public function update($id, array $datasModified) {
        $user = $this->findById($id);
        $isChangePassword = (
            array_key_exists("password", $datasModified)
            && $user["password"] != $datasModified["password"]
        );

        if ($isChangePassword) {
            $datasModified["password"] = Hash::make($datasModified["password"]);
        }
        $this->repository->update($id, $datasModified);
    }

}