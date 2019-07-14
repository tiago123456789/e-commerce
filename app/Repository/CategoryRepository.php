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

    public function hasProductsAssociate($id) {
        $categories = $this->getModel()->whereHas("posts", function($query) use ($id) {
            $query->where("category_id", $id);
        })->get();

        $hasProductAssociate = count($categories) > 0;
        return $hasProductAssociate;
    }

    public function findByDescription(String $description) {
        $description = strtolower($description);
        return $this->getModel()->where(DB::raw("lower(description)", $description))->first();
    }

    public function getRelationshipLoadingEager(): array
    {
        return [];
    }
}