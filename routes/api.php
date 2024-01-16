<?php

use App\Http\Controllers\Api\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavoritesController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\productController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\AcceptLanguageMiddleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResources([
    'categories' => CategoryController::class,
    'products' => productController::class,
    'users' => UserController::class,
    'favorite' => FavoritesController::class,
    'orders' => OrderController::class,
    'admin/orders'=> AdminOrderController::class
]);

Route::get('get_product/{category}', [CategoryController::class, 'getProductCategory']);
Route::get('search_product', [productController::class, 'search_product']);
Route::get('addedRecently', [productController::class, 'addedRecently']);
