<?php


namespace App\Bo;


use App\Exceptions\LogicNegociationException;
use App\Exceptions\MessageException;
use App\Exceptions\NotFoundException;
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

    public function findAllPaginate(array $fieldsReturn = [])
    {
        return $this->repository->findAllPaginate($fieldsReturn);
    }

    public function findAll(array $fieldsReturn = [])
    {
        return $this->repository->findAll($fieldsReturn);
    }

    public function findAllByCateoryPaginate($idCategory)
    {
        return $this->repository->findAllByCateoryPaginate($idCategory);
    }

    public function save($newRegister)
    {
        $hasRegisterWithDescription = $this->repository->findByDescription($newRegister["description"]);

        if ($hasRegisterWithDescription) {
            throw new LogicNegociationException(MessageException::DESCRIPTION_USED);
        }

        $file = $newRegister["image"];
        $newRegister["url_image"] = $this->doUploadImage($file);
        unset($newRegister["image"]);
        $productCreated = $this->repository->save($newRegister);
        $this->repository->setCategoriesProduct($productCreated["id"], $newRegister["categories"]);
    }


    private function doUploadImage($file)
    {
        $nameFile = time() . $file->getClientOriginalName();
        return $this->storage->store(
            $nameFile, file_get_contents($file), "public"
        );
    }

    public function findById($id) {
        $user = $this->repository->findById($id);
        if (!$user) {
            throw new NotFoundException(MessageException::NOT_FOUND_REGISTER, ["Product"]);
        }

        return $user;
    }

    public function remove($id) {
        $product = $this->findById($id);
        $this->repository->remove($id);
        $nameImage = $this->getNameImage($product["url_image"]);
        $this->storage->remove($nameImage);
    }

    public function update($id, array $datasModified) {
        $product = $this->findById($id);
        $categories = $datasModified["categories"];
        unset($datasModified["categories"]);

        $isChangeImage = $datasModified["image"];
        if ($isChangeImage) {
            $this->storage->remove($this->getNameImage($product["url_image"]));
            $file = $datasModified["image"];
            $datasModified["url_image"] = $this->doUploadImage($file);
            unset($datasModified["image"]);
        }

        $this->repository->update($id, $datasModified);
        $this->repository->setCategoriesProduct($id, $categories);

    }

    private function getNameImage($urlImage) {
        return array_reverse(explode("/", $urlImage))[0];
    }
}