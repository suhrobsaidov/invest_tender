<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class UserController extends Controller
{
    public function user($id)
    {
        $user = User::find($id);
      
        return $user;
    }




}
