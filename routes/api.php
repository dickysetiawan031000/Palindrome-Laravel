<?php

use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\PalindromeController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->json([
        'message' => 'Method Not Allowed'
    ], 405);
});

Route::prefix('v1')->group(function () {
    Route::get('/', function () {
        return response()->json(['message' => 'Hello Laravel Developers']);
    });

    Route::get('/check-palindrome', [PalindromeController::class, 'checkPalindrome']);

    Route::post('/language', [LanguageController::class, 'store']);
    Route::get('/language/{id}', [LanguageController::class, 'show']);
    Route::get('/languages', [LanguageController::class, 'index']);
    Route::patch('/language/{id}', [LanguageController::class, 'update']);
    Route::delete('/language/{id}', [LanguageController::class, 'destroy']);
});
