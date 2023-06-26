<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class APIController extends Controller
{
    function allUser() {
        $user = User::all();
        return UserResource::collection($user);
    }
}
