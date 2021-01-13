<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request, JsonResponse
};
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User, Items, Purchase, PurchaseItem
};

class PurchaseController extends Controller
{
    function cart(){
        return view("pages.purchase.cart");
    }

    function items() : JsonResponse
    {
        if(Auth::check()){
            $purchase = Purchase::where([
                "buyer_id" => Auth::id(),
                "purchase_status" => "cart"
            ])->first();
            
            if($purchase){  
                $items = PurchaseItem::select("purchase_items.id","purchase_items.name", "purchase_items.price", "items.description", "items.image")->where([
                    "purchase_items.buyer_id" => Auth::id(),
                    "purchase_items.purchase_id" => $purchase->id,
                ])->join("items", "items.id", "=", "purchase_items.item_id", "left")->get();

                return response()->json([
                    "cart" => true,
                    "purchase" => $purchase,
                    "items" => $items
                ]);
            }
        }

        return response()->json([
            "cart" => false,
        ]);
    }

    function add_to_cart(Request $request) : JsonResponse
    {

        if(Auth::check()){
            if(Auth::user()->buyer_mode){
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

                return response()->json([]);
            }

            return response()->json([
                "login" => true,
                "buyer" => false,
            ]);
        }

        return response()->json([
            "login" => false,
            "buyer" => true,
        ]);
    }

    function atc_record($request){
        $item = Items::find($request->id);

        $purchase = Purchase::where([
            "buyer_id" => Auth::user()->id,
            "purchase_status" => "cart"
        ])->first();

        if($purchase){
            // add to cart existing purchase
            $purchase->total_amount = $purchase->total_amount + $item->price;
            $purchase->save();

            PurchaseItem::insert([
                "purchase_id" => $purchase->id,
                "buyer_id" => Auth::id(),
                "item_id" => $item->id,
                "name" => $item->name,
                "price" => $item->price,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ]);
        }else{
            // add to cart new purchase record
            $purchase = new Purchase;
            $purchase->buyer_id = Auth::id();
            $purchase->total_amount = $item->price;
            $purchase->purchase_status = "cart";
            $purchase->created_at = date("Y-m-d H:i:s");
            $purchase->updated_at = date("Y-m-d H:i:s");
            $purchase->save();

            PurchaseItem::insert([
                "purchase_id" => $purchase->id,
                "buyer_id" => Auth::id(),
                "item_id" => $item->id,
                "name" => $item->name,
                "price" => $item->price,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ]);
        }
    }

    function remove_from_cart(Request $request) : JsonResponse
    {
        $find = PurchaseItem::find($request->id);
        if($find){
            $findP = Purchase::find($find->purchase_id);
            if($findP && $findP->purchase_status == "cart"){
                $findItems = PurchaseItem::where([
                    "purchase_id" => $findP->id,
                    "buyer_id" => Auth::id(),
                ])->get();

                if($findItems && $findItems->count() == 1){
                    $findP->delete();
                }
            }

            $find->delete();
        }
        return response()->json([]);
    }
    
    function checkout(Request $request) : JsonResponse
    {
        $purchase = Purchase::where([
            "buyer_id" => Auth::id(),
            "purchase_status" => "cart"
        ])->first();

        $purchase->purchased_at = date("Y-m-d H:i:s");
        $purchase->purchase_status = "paid";
        $purchase->save();

        return response()->json([]);
    }

    function get_purchase_list(Request $request) : JsonResponse
    {
        $purchases = Purchase::where([
            "buyer_id" => Auth::id(),
            "purchase_status" => "paid"
        ])->get();

        foreach($purchases as $purchase){
            $purchase->purchased_at = date("F d, Y - h:i A", strtotime($purchase->purchased_at));
            $items = PurchaseItem::select("purchase_items.id","purchase_items.name", "purchase_items.price", "items.description", "items.image")->where([
                "purchase_items.buyer_id" => Auth::id(),
                "purchase_items.purchase_id" => $purchase->id,
            ])->join("items", "items.id", "=", "purchase_items.item_id", "left")->get();

            $purchase->items = $items;
            $purchase->total_items = $items->count();
        }

        return response()->json([ $purchases ]);
    }

    function get_orders_list(Request $request) : JsonResponse
    {
        $items = Items::where([
            "seller_id" => Auth::id(),
        ])->get();

        foreach ($items as $key => $item) {
            $purchased_items = PurchaseItem::where("item_id", $item->id)->get();

            $item->total_items = $purchased_items->count();
            $item->total_amount = $purchased_items->sum("price");
        }

        return response()->json([ $items ]);
    }
}
