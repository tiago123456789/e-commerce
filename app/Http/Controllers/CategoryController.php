<?php

namespace App\Http\Controllers;

use App\Bo\CategoryBo;
use App\Exceptions\EcommerceException;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    private $bo;

    public function __construct(CategoryBo $categoryBo)
    {
        $this->bo = $categoryBo;
    }

    public function index() {
        $categories = $this->bo->findAll(["id", "description"]);
        return view("admin.category.index", compact("categories"));
    }

    public function newPage() {
        return view("admin.category.new");
    }

    public function edit($id) {
        try {
            $category = $this->bo->findById($id);
            return view("admin.category.new", compact("category"));
        } catch(EcommerceException $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }

    public function update($id, Request $request) {
        try {
            $datasModified = $request->except("_token");
            $this->bo->update($id, $datasModified);
            return Redirect::route("category.list")
                ->with("success", "Category edit with success!");
        } catch(EcommerceException $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }

    public function save(CategoryRequest $request) {
        $request->validated();
        try {
            $newRegister = $request->except("_token");
            $this->bo->save($newRegister);
            return Redirect::route("category.list")
                            ->with("success", "Category register with success!");
        } catch(EcommerceException $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }

    public function remove($id) {
        try {
            $this->bo->remove($id);
            return Redirect::route("category.list")
                ->with("success", "Category removed with success!");
        } catch(EcommerceException $exception) {
            return back()->withErrors([ $exception->getMessage() ]);
        }
    }
}
