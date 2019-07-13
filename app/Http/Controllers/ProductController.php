<?php

namespace App\Http\Controllers;

use App\Bo\CategoryBo;
use App\Bo\ProductBo;
use App\Exceptions\EcommerceException;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Service\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    private $bo;
    private $storage;

    public function __construct(ProductBo $categoryBo, Storage $storage)
    {
        $this->bo = $categoryBo;
        $this->storage = $storage;
    }

    public function index() {
        $products = $this->bo->findAll(["id", "description"]);
        return view("admin.product.index", compact("products"));
    }

    public function newPage() {
        return view("admin.product.new");
    }
//
//    public function edit($id) {
//        try {
//            $category = $this->bo->findById($id);
//            return view("admin.category.new", compact("category"));
//        } catch(EcommerceException $exception) {
//            return back()->withErrors($exception->getMessage());
//        }
//    }
//
//    public function update($id, Request $request) {
//        try {
//            $datasModified = $request->except("_token");
//            $this->bo->update($id, $datasModified);
//            return Redirect::route("category.list")
//                ->with("success", "Category edit with success!");
//        } catch(EcommerceException $exception) {
//            return back()->withErrors($exception->getMessage());
//        }
//    }
//
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

//    public function remove($id) {
//        try {
//            $this->bo->remove($id);
//            return Redirect::route("category.list")
//                ->with("success", "Category removed with success!");
//        } catch(EcommerceException $exception) {
//            return back()->withErrors([ $exception->getMessage() ]);
//        }
//    }
}
