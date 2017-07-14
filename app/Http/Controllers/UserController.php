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

    public function profile() {
        $user = Auth::user();
        $data = array(
            'user' => $user
        );
        return view('profile', $data);
    }
}
