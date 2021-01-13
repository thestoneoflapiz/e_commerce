<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request, JsonResponse
};
use Illuminate\Support\Facades\{
    Auth
};
use App\Models\{
    Items
};

class ItemsController extends Controller
{
    function index(){
        return view("pages.items.index");
    }

    function catalog(Request $request) : JsonResponse
    {
        $list = Items::where("status", "approved")->get();
        return response()->json([ $list ]);
    }

    function list(Request $request) : JsonResponse
    {
        if(Auth::user()->type=="seller"){
            $list = Items::where("seller_id", Auth::id())->get();
        }else{
            $list = Items::all();
        }

        return response()->json([ $list ]);
    }

    function add(){
        return view("pages.items.add");
    }

    function store(Request $request) : JsonResponse
    {
        Items::insert([
            "name" => $request->name,
            "image" => $request->image,
            "description" => $request->description,
            "price" => $request->price,
            "seller_id" => Auth::user()->id,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        return response()->json([], 201);
    }

    function edit(Request $request){
        $item = Items::find($request->id);
        return view("pages.items.edit", [ "item" => $item]);
    }

    function update(Request $request) : JsonResponse
    {
        Items::find($request->id)->update([
            "name" => $request->name,
            "image" => $request->image,
            "description" => $request->description,
            "price" => $request->price,
            "status" => "pending",
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        return response()->json([]);
    }   

    function change(Request $request) : JsonResponse
    {
        Items::find($request->id)->update([
            "status" => $request->status,
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        return response()->json([]);
    }    
}
