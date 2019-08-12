<?php

namespace App\Http\Controllers;

use App\Bo\CategoryBo;
use App\Bo\ProductBo;
use App\Model\Product;

class SiteController extends Controller
{

    private $categoryBo;

    private $productBo;

    public function __construct(CategoryBo $categoryBo, ProductBo $productBo)
    {
        $this->categoryBo = $categoryBo;
        $this->productBo = $productBo;
    }

    public function index()
    {
        $categories = $this->categoryBo->findAll(["id", "description"]);
        return view("site.index", compact("categories"));
    }

    public function pageProduct($idCategory = null) {
        $category = null;
        $categories = $this->categoryBo->findAll(["id", "description"]);
        if ($idCategory) {
            $category = $this->categoryBo->findById($idCategory);
            $products = $this->productBo->findAllByCateoryPaginate($idCategory);
        } else {
            $products = $this->productBo->findAllPaginate(["id", "title", "description", "price", "url_image"]);
        }
        return view("site.produtos", compact("products", "categories", 'category'));
    }

    public function pageProductDetails($id)
    {
        $product = $this->productBo->findById($id);
        return view("site.productDetails", compact("product"));
    }
}
