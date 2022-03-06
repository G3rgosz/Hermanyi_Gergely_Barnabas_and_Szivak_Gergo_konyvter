<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdvertisementController;

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

    Route::get("/admin/reportedads", [AdminController::class, "reportedads"]);
    Route::get("/admin/users", [AdminController::class, "users"]);
    Route::get("/admin/reportedads/{adtitle}", [AdminController::class, "searchads"]);
    Route::get("/admin/users/{username}", [AdminController::class, "searchuser"]);
    Route::delete("/admin/reportedads/{id}", [AdminController::class, "deleteads"]);
    Route::delete("/admin/users/{id}", [AdminController::class, "deleteuser"]);

    Route::post("/web/books", [BookController::class, "create"]);

    Route::post("/web/advertisements", [AdvertisementController::class, "create"]);
}); 
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

Route::get("/web/books", [BookController::class, "index"]);
Route::get("/web/books/{id}", [BookController::class, "show"]);

Route::get("/web/advertisements", [AdvertisementController::class, "index"]);
Route::get("/web/advertisements/{id}", [AdvertisementController::class, "show"]);


