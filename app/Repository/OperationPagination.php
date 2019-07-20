<?php

namespace App\Repository;


trait OperationPagination
{

    public function findAllPaginate(array $fieldsReturn = [], $quantityItensDisplay = 10) {
        $wasMencionatedFieldsReturn = count($fieldsReturn) > 0;
        if ($wasMencionatedFieldsReturn) {
            return $this->getModel()::paginate($quantityItensDisplay, $fieldsReturn);
        }

        return $this->getModel()::paginate($quantityItensDisplay);
    }
}