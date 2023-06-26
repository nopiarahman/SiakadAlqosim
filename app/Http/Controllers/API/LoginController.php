<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LoginResource;

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
            $data = Auth::user();
            $data['token']=$token;
            $data['role']=Auth::user()->getRoleNames()->first();
            return LoginResource::collection([$data]);
        }
        return response()->json(['messages' => 'Invalid credentials', 401]);
    }
    public function logout(Request $request) {
        // menghapus token login saat ini
        $request->user()->currentAccessToken()->delete();
        return response()->json(['messages' => 'Berhasil Logout', 200]);
    }
}
