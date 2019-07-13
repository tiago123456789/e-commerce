<?php


namespace App\Repository;


use App\Model\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends Repository
{

    public function __construct()
    {
        parent::__construct(new Product());
    }

    public function findByDescription(String $description) {
        $description = strtolower($description);
        return $this->getModel()->where(DB::raw("lower(description)", $description))->first();
    }

}