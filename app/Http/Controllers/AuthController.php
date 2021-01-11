<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request, JsonResponse
};
use Illuminate\Support\Facades\{
    Auth, Hash
};
use App\Models\User;

class AuthController extends Controller
{
    function login(Request $request) : JsonResponse
    {
        $data = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"]
        ]);

        if (Auth::attempt(['email' => $data["email"], 'password' => $data["password"]])) {
            return response()->json([
                "type" => Auth::user()->type
            ]);
        }

        return response()->json([
            "message" => "User email & password does not match!"
        ], 401);
    }

    function register(Request $request) : JsonResponse
    {
        $data = $request->validate([
            "name" => ["required"],
            "email" => ["required", "unique:users", "email"],
            "password" => ["required", "min:6"],
            "password_confirmation" => ["required", "same:password" ],
            "type" => ["required"]
        ]);

        if($data){

            $new_user = new User;
            $new_user->name = $data["name"];
            $new_user->email = $data["email"];
            $new_user->email_verified_at = date("Y-m-d H:i:s");
            $new_user->password = bcrypt($data["password"]);
            $new_user->type = $data["type"];
            $new_user->buyer_mode = $data["type"]=="buyer" ? 1 : 0;
            $new_user->save();

            return response()->json([]);
        }

        return response()->json([], 400);
    }

    function logout() {

        Auth::logout();
        return redirect("/");
    }
}
