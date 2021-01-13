<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request, JsonResponse
};
use Illuminate\Support\Facades\{
    Auth
};
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pages.users.index");
    }

    function list(Request $request) : JsonResponse
    {
        $list = User::where("id", "!=", Auth::user()->id)->get();

        return response()->json([ $list ]);
    }

    function change(Request $request) : JsonResponse
    {
        $user = User::find($request->id);
        $user->buyer_mode = 1;
        $user->save();

        return response()->json([]);
    }
}
