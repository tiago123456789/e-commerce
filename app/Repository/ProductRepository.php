<?php


namespace App\Repository;


use App\Model\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends Repository
{

    use OperationPagination;

    public function __construct()
    {
        parent::__construct(new Product());
    }

    public function setCategoriesProduct($idProduct, $idsCategories) {
        $product = $this->findById($idProduct);
        $product->categories()->sync($idsCategories);
    }

    public function findByDescription(String $description) {
        $description = strtolower($description);
        return $this->getModel()->where(DB::raw("lower(description)", $description))->first();
    }

    public function findAllByCateoryPaginate($idCategory) {
        return $this->getModel()
            ->whereHas("categories", function($query) use ($idCategory) {
                $query->where("category_id", $idCategory);
            })->paginate();
    }

    public function findById($id)
    {
        return $this->getModel()
            ->with(array( "categories" => function($query) {
                $query->select("description");
            }))
            ->get(["id", "description", "url_image", "price"])
            ->first();
    }

    public function getRelationshipLoadingEager(): array
    {
        return [];
    }
}