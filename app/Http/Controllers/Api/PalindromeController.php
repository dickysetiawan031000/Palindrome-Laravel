<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PalindromeController extends Controller
{
    public function checkPalindrome(Request $request)
    {
        try {
            $request->validate([
                'text' => 'required|string'
            ], [
                'text.required' => 'Text is required',
                'text.string' => 'Text must be a string'
            ]);

            $text = $request->text;
            $text = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $text));
            $reverse = strrev($text);

            if ($text == $reverse) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Palindrome'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Not Palindrome'
                ], 400);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 400);
        }

    }
}
