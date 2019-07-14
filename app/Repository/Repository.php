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
        return $this->getNamespaceModel()::create($newRegister);
    }

    public function findAll(array $fieldsReturn = []) {
        $wasInformatedFieldsReturn = count($fieldsReturn) > 0;
        $hasRelationshipLoadingEager = count($this->getRelationshipLoadingEager()) > 0;
        if ($hasRelationshipLoadingEager && !$wasInformatedFieldsReturn) {
            return $this->getNamespaceModel()::with($this->getRelationshipLoadingEager())->get();
        } else if($hasRelationshipLoadingEager && $wasInformatedFieldsReturn) {
            return $this->getNamespaceModel()::with($this->getRelationshipLoadingEager())->get($fieldsReturn);
        } else if (!$hasRelationshipLoadingEager && $wasInformatedFieldsReturn) {
            return $this->getNamespaceModel()::all($fieldsReturn);
        } else {
            return $this->getNamespaceModel()::all();
        }
    }

    public function findById($id) {
        $hasRelationshipLoadingEager = count($this->getRelationshipLoadingEager()) > 0;
        if ($hasRelationshipLoadingEager) {
            return $this->model->where("id", $id)
                ->with($this->getRelationshipLoadingEager())
                ->first();
        }
        return $this->model->where("id", $id)->first();
    }

    public function remove($id) {
        $this->getNamespaceModel()::destroy($id);
    }

    public function update($id, $datasModified) {
        $this->getNamespaceModel()::where("id", $id)->update($datasModified);
    }

    abstract public function getRelationshipLoadingEager(): array;


    private function getNamespaceModel() {
        return get_class($this->model);
    }
}