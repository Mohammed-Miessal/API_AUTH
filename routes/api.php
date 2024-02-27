<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group([], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    // Route::get('user/infos', [AuthController::class, 'infos'])->name('infos.user');
});



Route::prefix('role')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('role.index');
    Route::get('/index', [RoleController::class, 'index'])->name('role.index');
    Route::get('/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('edit/{role}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/update/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::get('/show/{role}', [RoleController::class, 'show'])->name('role.show');
    Route::delete('/delete/{role}', [RoleController::class, 'destroy'])->name('role.delete');
});


Route::group(['middleware' => 'role:Super Admin'], function() {
    Route::get('list' , [AuthController::class, 'list'])->name('role.list');
 });
 
 Route::group(['middleware' => 'role:user'], function() {
    //
 });