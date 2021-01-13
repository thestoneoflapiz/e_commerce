<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request, JsonResponse
};
use App\Models\{
    User, Items, Purchase, PurchaseItem
};

class PurchaseController extends Controller
{
    function cart(){
        return view("pages.purchase.cart");
    }

    function add_to_cart(Request $request) : JsonResponse
    {

        if(Auth::check()){
            $find = PurchaseItem::where([
                "item_id" => $request->id,
                "buyer_id" => Auth::user()->id,
            ])->first();

            if($find){
                $findP = Purchase::find($find->purchase_id);
                if($findP && $findP->purchase_status == "cart"){
                }else{
                    $this->atc_record($request);
                }
            }else{
                $this->atc_record($request);
            }
        }
        return response()->json([
            "login" => Auth::check(),
        ]);
    }

    function atc_record($request){
        $purchase = Purchase::where([
            "buyer_id" => Auth::user()->id,
            "purchase_status" => "cart"
        ])->first();

        if($purchase){
            // add to cart existing purchase
        }else{
            // add to cart new purchar record
        }
    }

    function remove_from_cart(Request $request) : JsonResponse
    {
        return response()->json([]);
    }
    
    function checkout(Request $request) : JsonResponse
    {
        return response()->json([]);
    }
}
