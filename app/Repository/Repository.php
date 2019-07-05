<?php


namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

abstract class Repository
{

    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected function getModel() {
        return $this->model;
    }

    public function save($newRegister) {
        $this->getNamespaceModel()::create($newRegister);
    }

    public function findAll(array $fieldsReturn = []) {
        $wasInformatedFieldsReturn = count($fieldsReturn) > 0;
        if ($wasInformatedFieldsReturn) {
            return $this->getNamespaceModel()::all();
        } else {
            return $this->getNamespaceModel()::all($fieldsReturn);
        }
    }

    public function findById($id) {
        return $this->model->where("id", $id)->first();
    }

    public function remove($id) {
        $this->getNamespaceModel()::destroy($id);
    }

    public function update($id, $datasModified) {
        $this->getNamespaceModel()::where("id", $id)->update($id, $datasModified);
    }

    private function getNamespaceModel() {
        return get_class($this->model);
    }
}