<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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
});



Route::group(['middleware' => ['role:Super Admin,Admin', 'auth:api']], function () {

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

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/index', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::get('/show/{user}', [UserController::class, 'show'])->name('user.show');
        Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');
    });

    Route::prefix('permission')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/index', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('/store', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('edit/{permission}', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::put('/update/{permission}', [PermissionController::class, 'update'])->name('permission.update');
        Route::get('/show/{permission}', [PermissionController::class, 'show'])->name('permission.show');
        Route::delete('/delete/{permission}', [PermissionController::class, 'destroy'])->name('permission.delete');
    });

    Route::get('list', [UserController::class, 'list'])->name('users.list');

    Route::get('user/{user}/roles', [UserController::class, 'userRoles'])->name('user.roles');

    Route::post('user/{user}/roles', [UserController::class, 'assignRole'])->name('user.assign.role');

    Route::delete('user/{user}/roles/{role}', [UserController::class, 'revokeRole'])->name('user.revoke.role');
});
