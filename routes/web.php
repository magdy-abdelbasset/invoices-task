<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(env("USER_WEB",route("dashboard.home")));
});
Route::group(['prefix' => 'dashboard',"as"=>"dashboard."], function ($router) {
    Route::get('/login', [AuthController::class, "login"])->name("login");
    Route::post('/login', [AuthController::class, "loginPost"])->name("login-post");
    Route::get('/logout', [AuthController::class, "logout"])->name('logout');


    Route::group(["middleware"=>["auth:web"]], function () {
        Route::get('/', [AdminController::class, "home"])->name("home");
        Route::resource('/admins', AdminController::class)->except("show");
        Route::post('/admins/{id}/active', [AdminController::class,'active'])->name('admins.active');
        Route::post('/admins/{id}/unactive', [AdminController::class,'unactive'])->name('admins.unactive');

        Route::resource('/roles', RoleController::class)->except("show");
        Route::resource('/customers', CustomerController::class);
        Route::post('/customers/{id}/active', [CustomerController::class,'active'])->name('customers.active');
        Route::post('/customers/{id}/unactive', [CustomerController::class,'unactive'])->name('customers.unactive');

        Route::resource('/invoices', InvoiceController::class);
        Route::post('/invoices/{id}/active', [InvoiceController::class,'active'])->name('invoices.active');
        Route::post('/invoices/{id}/unactive', [InvoiceController::class,'unactive'])->name('invoices.unactive');
    });
});

