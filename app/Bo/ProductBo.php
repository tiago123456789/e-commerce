<?php


namespace App\Bo;


use App\Exceptions\LogicNegociationException;
use App\Exceptions\MessageException;
use App\Repository\ProductRepository;
use App\Service\Storage;

class ProductBo
{

    private $repository;

    private $storage;

    public function __construct(Storage $storage)
    {
        $this->repository = new ProductRepository();
        $this->storage = $storage;
    }

    public function findAll(array $fieldsReturn = []) {
        return $this->repository->findAll($fieldsReturn);
    }

    public function save($newRegister) {
        $hasRegisterWithDescription = $this->repository->findByDescription($newRegister["description"]);

        if ($hasRegisterWithDescription) {
            throw new LogicNegociationException(MessageException::DESCRIPTION_USED);
        }

        $file = $newRegister["image"];
        $nameFile = time() . $file->getClientOriginalName();
        $newRegister["url_image"] = $this->storage->store(
            $nameFile, file_get_contents($file), "public"
        );
        unset($newRegister["image"]);
        $this->repository->save($newRegister);
    }
//
//    public function findById($id) {
//        $user = $this->repository->findById($id);
//        if (!$user) {
//            throw new NotFoundException(MessageException::NOT_FOUND_REGISTER, ["Category"]);
//        }
//
//        return $user;
//    }
//
//    public function remove($id) {
//        $this->findById($id);
//        // TODO: Add rule check if category not associate a product.
//        $this->repository->remove($id);
//    }
//
//    public function update($id, array $datasModified) {
//        $user = $this->findById($id);
//        $this->repository->update($id, $datasModified);
//    }

}