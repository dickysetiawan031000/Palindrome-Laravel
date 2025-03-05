<?php

use App\Http\Controllers\Api\PalindromeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::get('/check-palindrome', [PalindromeController::class, 'checkPalindrome']);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
