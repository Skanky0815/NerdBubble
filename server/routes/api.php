<?php declare(strict_types=1);

use App\Http\Controllers\ArticleListController;
use App\Http\Controllers\ProductMarkController;
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
    Route::get('/me', fn (Request $request) => $request->user());

    Route::get('/articles', ArticleListController::class);
    Route::post('/products/{id}/mark', ProductMarkController::class);
});
