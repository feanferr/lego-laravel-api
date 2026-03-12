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
