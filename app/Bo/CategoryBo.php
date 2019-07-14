<?php


namespace App\Bo;


use App\Exceptions\LogicNegociationException;
use App\Exceptions\MessageException;
use App\Exceptions\NotFoundException;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use http\Message;
use Illuminate\Support\Facades\Hash;

class CategoryBo
{

    private $repository;

    public function __construct()
    {
        $this->repository = new CategoryRepository();
    }

    public function findAll(array $fieldsReturn = []) {
        return $this->repository->findAll($fieldsReturn);
    }

    public function save($newRegister) {
        $hasRegisterWithDescription = $this->repository->findByDescription($newRegister["description"]);

        if ($hasRegisterWithDescription) {
            throw new LogicNegociationException(MessageException::DESCRIPTION_USED);
        }

        $this->repository->save($newRegister);
    }

    public function findById($id) {
        $user = $this->repository->findById($id);
        if (!$user) {
            throw new NotFoundException(MessageException::NOT_FOUND_REGISTER, ["Category"]);
        }

        return $user;
    }

    public function remove($id) {
        $this->findById($id);
        $hasProductsAssociate = $this->repository->hasProductsAssociate($id);
        if ($hasProductsAssociate) {
            throw new LogicNegociationException(MessageException::PRODUCTS_ASSOCIATE_CATEGORY);
        }
        $this->repository->remove($id);
    }

    public function update($id, array $datasModified) {
        $user = $this->findById($id);
        $this->repository->update($id, $datasModified);
    }

}