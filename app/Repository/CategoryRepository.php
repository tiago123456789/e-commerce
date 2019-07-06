<?php


namespace App\Repository;


use App\Model\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends Repository
{

    public function __construct()
    {
        parent::__construct(new Category());
    }

    public function findByDescription(String $description) {
        $description = strtolower($description);
        return $this->getModel()->where(DB::raw("lower(description)", $description))->first();
    }
}