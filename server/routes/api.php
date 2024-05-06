<?php declare(strict_types=1);

use App\Http\Controllers\ArticleListController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\KeywordListController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductMarkController;
use App\Http\Resources\UserResource;
use App\Models\Keyword;
use Domains\Article\ValueObjects\Id;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', fn (Request $request) => new UserResource($request->user()));

    Route::get('/articles', ArticleListController::class);
    Route::post('/products/{id}/mark', ProductMarkController::class);
    Route::get('/marked-products', ProductListController::class);

    Route::apiResource('keywords', KeywordController::class)->only('index', 'store', 'destroy');
});
