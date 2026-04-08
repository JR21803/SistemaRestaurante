<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PlateController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DiscountController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [AuthController::class, 'profile']);

/*
|--------------------------------------------------------------------------
| CUSTOMERS
|--------------------------------------------------------------------------
*/
Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| PLATES
|--------------------------------------------------------------------------
*/
Route::get('/plates', [PlateController::class, 'index']);
Route::post('/plates', [PlateController::class, 'store']);
Route::get('/plates/{id}', [PlateController::class, 'show']);
Route::put('/plates/{id}', [PlateController::class, 'update']);
Route::delete('/plates/{id}', [PlateController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| ORDERS
|--------------------------------------------------------------------------
*/
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| ORDER DETAILS
|--------------------------------------------------------------------------
*/
Route::get('/orders/{id}/details', [OrderController::class, 'details']);
Route::post('/orders/{id}/details', [OrderController::class, 'addDetail']);

/*
|--------------------------------------------------------------------------
| DISCOUNTS
|--------------------------------------------------------------------------
*/
Route::post('/orders/calculate-discount', [DiscountController::class, 'calculate']);

/*
|--------------------------------------------------------------------------
| INVOICES
|--------------------------------------------------------------------------
*/
Route::get('/invoices', [InvoiceController::class, 'index']);
Route::post('/invoices', [InvoiceController::class, 'store']);
Route::get('/invoice/{id}', [InvoiceController::class, 'show']);

/*
|--------------------------------------------------------------------------
| MENUS
|--------------------------------------------------------------------------
*/
Route::get('/menus', [MenuController::class, 'index']);
Route::post('/menus', [MenuController::class, 'store']);
Route::put('/menus/{id}', [MenuController::class, 'update']);
Route::delete('/menus', [MenuController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| INVENTORY
|--------------------------------------------------------------------------
*/
Route::get('/inventory', [InventoryController::class, 'index']);
Route::post('/inventory', [InventoryController::class, 'store']);
Route::put('/inventory/{id}', [InventoryController::class, 'update']);
Route::delete('/inventory/{id}', [InventoryController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| RAW MATERIAL
|--------------------------------------------------------------------------
*/
Route::get('/raw-material', [RawMaterialController::class, 'index']);
Route::post('/raw-material', [RawMaterialController::class, 'store']);
Route::get('/raw-material/{id}', [RawMaterialController::class, 'show']);
Route::put('/raw-material/{id}', [RawMaterialController::class, 'update']);
Route::delete('/raw-material/{id}', [RawMaterialController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| PAYMENTS
|--------------------------------------------------------------------------
*/
Route::post('/payments/process', [PaymentController::class, 'process']);