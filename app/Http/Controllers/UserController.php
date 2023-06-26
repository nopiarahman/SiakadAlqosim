<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function admin() {
        // $admin = User
        return view('user.admin');
    }
}
