<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request){
        $user = \Auth::user();
        return response()->json(compact('user'));
    }
}
