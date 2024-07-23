<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Admin\ChartController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//api for showing products from UI
Route::get('/products', [ProductController::class, 'index'])->name('api.products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('api.products.show');
Route::get('/categories', [ProductController::class, 'categories'])->name('api.products.categories');

//api for checkout
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('api.checkout.process');
});

//api for charts
Route::prefix('/dashboard')->group(function(){
    Route::get('/pie-chart', [ChartController::class, 'pieChart'])->name('api.charts.pie');
    Route::get('/line-chart', [ChartController::class, 'lineChart'])->name('api.charts.line');
    Route::get('/bar-chart', [ChartController::class, 'barChart'])->name('api.charts.bar');
});