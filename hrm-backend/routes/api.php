<?php

use App\Http\Controllers\ElasticsearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('elasticsearch')->group(function () {
    Route::post('', [ElasticsearchController::class, "createIndex"]);
    Route::get('', [ElasticsearchController::class, "getInfo"]);
    Route::delete('/{index}',[ElasticsearchController::class, "deleteIndex"]);
    // Route::get('', [BeneficiariesController::class, "getBeneficiaries"]);
    // Route::get('/{id}', [BeneficiariesController::class, "findBeneficiariesById"]);
    // Route::put('/{id}', [BeneficiariesController::class, "updateBeneficiaries"]);
});

Route::prefix('document')->group(function () {
    Route::post('',[ElasticsearchController::class, "createDocument"]);
    Route::post('/multiple',[ElasticsearchController::class,"createMultipleDocument"]);
});