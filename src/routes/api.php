<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json([
        "message" => "API funcionando"
    ]);
});

Route::get('/sets', [SetController::class, 'index']);
Route::post('/sets', [SetController::class, 'store']);

Route::prefix('v1')->group(function () {

    Route::get('/sets', [SetController::class, 'index']);
    Route::post('/sets', [SetController::class, 'store']);
    Route::get('/sets/{id}', [SetController::class, 'show']);
    Route::put('/sets/{id}', [SetController::class, 'update']);
    Route::delete('/sets/{id}', [SetController::class, 'destroy']);

});
