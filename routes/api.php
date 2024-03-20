<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubcategoryController;



// ROUTES FOR AUTHENTICATION
Route::group([], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
});



// Those routes are for all users can access
Route::group([], function () {
    Route::get('showdetails', [UserController::class, 'showDetails'])->name('user.show.details');
});


// Those routes are for Admin & Super Admin  can access
Route::group(['middleware' => ['role:Super Admin,Admin', 'auth:api']], function () {

    Route::resources(['role' => RoleController::class]);
    Route::resources(['permission' => PermissionController::class]);
    Route::resources(['user' => UserController::class]);
});


// Those routes are for Admin & Super Admin &  Stock Manager can access
Route::group(['middleware' => ['role:Super Admin,Admin,Stock Manager', 'auth:api']], function () {

    Route::resources(['categories' => CategoryController::class]);
    Route::resources(['subcategories' => SubcategoryController::class]);
});
