<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\GenreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::post("/logout", [AuthController::class, "logout"]);

    Route::put("/account/{id?}", [AccountController::class, "update"]);
    Route::delete("/account/{id?}", [AccountController::class, "delete"]);

    Route::get("/admin/reportedads", [AdminController::class, "reportedads"]);
    Route::get("/admin/users", [AdminController::class, "users"]);
    Route::get("/admin/reportedads/{adtitle}", [AdminController::class, "searchads"]);
    Route::get("/admin/users/{username}", [AdminController::class, "searchuser"]);
    Route::put("/admin/reportedads/remove/{id}", [AdminController::class, "removeReport"]);

    Route::post("/web/books", [BookController::class, "create"]);
    Route::put("/web/books/{id}", [BookController::class, "update"]);
    Route::delete("/web/books/{id}", [BookController::class, "delete"]);

    Route::get("/web/advertisements/my", [AdvertisementController::class, "getMyAds"]);
    Route::post("/web/advertisements", [AdvertisementController::class, "create"]);
    Route::put("/web/advertisements/{id}", [AdvertisementController::class, "update"]);
    Route::put("/web/advertisements/report/{id}", [AdvertisementController::class, "reportAd"]);
    Route::delete("/web/advertisements/{id}", [AdvertisementController::class, "delete"]);
}); 
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

Route::get("/web/books", [BookController::class, "index"]);
Route::get("/web/books/{id}", [BookController::class, "show"]);

Route::get("/web/genres", [GenreController::class, "index"]);

Route::get("/web/advertisements", [AdvertisementController::class, "index"]);
Route::get("/web/advertisements/{id}", [AdvertisementController::class, "show"]);
Route::post("/web/advertisements/filter", [AdvertisementController::class, "filter"]);


