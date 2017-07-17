<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    // Show user profile details
    public function profile() {
        $user = Auth::user();
        $apiKeys = \App\user_key::where('user_id', $user->id)->first();
        $data = array(
            'user' => $user,
            'apiKeys' => $apiKeys
        );
        return view('profile', $data);
    }
}
