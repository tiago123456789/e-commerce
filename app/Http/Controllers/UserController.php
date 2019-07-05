<?php

namespace App\Http\Controllers;

use App\Bo\UserBo;
use App\Exceptions\EcommerceException;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    private $bo;

    public function __construct(UserBo $userBo)
    {
        $this->bo = $userBo;
    }

    public function index() {
        $users = $this->bo->findAll(["name", "email", "id"]);
        return view("admin.user.index", compact("users"));
    }

    public function newPage() {
        return view("admin.user.new");
    }

    public function save(UserRequest $request) {
        $request->validated();
        try {
            $newRegister = $request->except("token");
            $this->bo->save($newRegister);
            return Redirect::route("user.list")
                            ->with("success", "User register with success!");
        } catch(EcommerceException $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }

    public function remove($id) {
        try {
            $this->bo->remove($id);
            return Redirect::route("user.list")
                ->with("success", "User removed with success!");
        } catch(EcommerceException $exception) {
            return back()->withErrors([ $exception->getMessage() ]);
        }
    }
}
