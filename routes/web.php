<?php

use Illuminate\Support\Facades\{
    Route, Auth
};
use App\Http\Controllers\{
    AuthController, ItemsController, PurchaseController,
    UserController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name("home");

Route::get('/login', function () {

    if(Auth::check()){
        return redirect(Auth::user()->type."/dashboard");
    }

    return view('pages.auth.login');
})->name("login");

Route::get('/register', function () {
    return view('pages.auth.register');
})->name("register");

Route::post('/login', [AuthController::class, "login"]);
Route::get('/logout', [AuthController::class, "logout"]);
Route::post('/register', [AuthController::class, "register"]);

Route::group(['middleware' => ['auth']], function() {
    Route::group(['middleware' => ['superadmin']], function() {
        Route::prefix("admin")->group(function(){
            Route::get("dashboard", function(){ return view("pages.admin.index"); });

            // items
            Route::prefix("items")->group(function(){
                Route::get("/", [ItemsController::class, "index"]);
                Route::get("list", [ItemsController::class, "list"]);
                Route::post("status", [ItemsController::class, "change"]);
            });

            // sellers
            Route::prefix("sellers")->group(function(){
                Route::get("/", [UserController::class, "index"]);
                Route::get("list", [UserController::class, "list"]);
                Route::post("status", [UserController::class, "change"]);
            });
        });
    });

    Route::group(['middleware' => ['seller']], function() {
        Route::prefix("seller")->group(function(){
            Route::get("dashboard", function(){ return view("pages.seller.index"); });

            // items
            Route::prefix("items")->group(function(){
                Route::get("/", [ItemsController::class, "index"]);
                Route::get("list", [ItemsController::class, "list"]);
                Route::get("add", [ItemsController::class, "add"]);
                Route::post("store", [ItemsController::class, "store"]);
                Route::get("edit/{id}", [ItemsController::class, "edit"]);
                Route::post("update", [ItemsController::class, "update"]);
            });

            Route::prefix("my-items")->group(function(){
                Route::get("/", function(){ return view("pages.seller.my-items"); });
                Route::get("list", [PurchaseController::class, "get_purchase_list"]);    
            });

            Route::prefix("orders")->group(function(){
                Route::get("/", function(){ return view("pages.items.orders"); });
                Route::get("list", [PurchaseController::class, "get_orders_list"]);    
            });
        });
    });

    Route::group(['middleware' => ['buyer']], function() {
        Route::prefix("buyer")->group(function(){
            Route::get("dashboard", function(){ return view("pages.buyer.index"); });

            Route::prefix("my-items")->group(function(){
                Route::get("/", function(){ return view("pages.buyer.my-items"); });
                Route::get("list", [PurchaseController::class, "get_purchase_list"]);    
            });
        });
    });
    
});

Route::get("items", [ItemsController::class, "catalog"]);

// cart
Route::prefix("cart")->group(function(){
    Route::get("/", [PurchaseController::class, "cart"]);
    Route::get("items", [PurchaseController::class, "items"]);
    Route::post("add", [PurchaseController::class, "add_to_cart"]);
    Route::post("remove", [PurchaseController::class, "remove_from_cart"]);
});

// checkout
Route::post("checkout", [PurchaseController::class, "checkout"]);
