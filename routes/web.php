<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, ItemController, PurchaseController, PurchaseItemController
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
    return view('pages.auth.login');
})->name("login");

Route::get('/register', function () {
    return view('pages.auth.register');
})->name("register");

Route::post('/login', [AuthController::class, "login"]);
Route::post('/register', [AuthController::class, "register"]);

Route::group(['middleware' => ['auth']], function() {
    Route::group(['middleware' => ['superadmin']], function() {
        Route::prefix("admin")->group(function(){
            Route::get("dashboard", function(){ return view("pages.admin.index"); });
        });
    });

    Route::group(['middleware' => ['seller']], function() {
        Route::prefix("seller")->group(function(){
            Route::get("dashboard", function(){ return view("pages.seller.index"); });
        });
    });

    Route::group(['middleware' => ['buyer']], function() {
        Route::prefix("buyer")->group(function(){
            Route::get("dashboard", function(){ return view("pages.buyer.index"); });
        });
    });
    
});
