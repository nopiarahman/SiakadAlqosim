<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected function loginApi(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($loginData)) {
            $token = Auth::user()->createToken('authToken')->plainTextToken;
            return response()->json(['data' => Auth::user(), 'token' => $token], 200);
        }
        return response()->json(['messages' => 'Invalid credentials', 401]);
    }
}
