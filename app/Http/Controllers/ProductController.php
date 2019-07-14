<?php

namespace App\Http\Controllers;

use App\Bo\CategoryBo;
use App\Bo\ProductBo;
use App\Exceptions\EcommerceException;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    private $bo;
    private $categoryBo;

    public function __construct(ProductBo $productBo, CategoryBo $categoryBo)
    {
        $this->bo = $productBo;
        $this->categoryBo = $categoryBo;
    }

    public function index() {
        $products = $this->bo->findAll();
        return view("admin.product.index", compact("products"));
    }

    public function newPage() {
        $categories = $this->categoryBo->findAll(["id", "description"]);
        return view("admin.product.new", compact("categories"));
    }

    public function edit($id) {
        try {
            $categories = $this->categoryBo->findAll(["id", "description"]);
            $product = $this->bo->findById($id);
            return view("admin.product.new", compact(
                "product", "categories"
            ));
        } catch(EcommerceException $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }

    public function update($id, Request $request) {
        try {
            $datasModified = $request->except("_token");
            $this->bo->update($id, $datasModified);
            return Redirect::route("product.list")
                ->with("success", "Product edit with success!");
        } catch(EcommerceException $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }

    public function save(ProductRequest $request) {
        $request->validated();
        try {
            $newRegister = $request->except("_token");
            $this->bo->save($newRegister);
            return Redirect::route("product.list")
                            ->with("success", "Product register with success!");
        } catch(EcommerceException $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }

    public function remove($id) {
        try {
            $this->bo->remove($id);
            return Redirect::route("product.list")
                ->with("success", "Product removed with success!");
        } catch(EcommerceException $exception) {
            return back()->withErrors([ $exception->getMessage() ]);
        }
    }
}
