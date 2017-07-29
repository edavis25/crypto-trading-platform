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

        //$this->encrypt();

        $user = Auth::user();
        $apiKeys = \App\user_key::where('user_id', $user->id)->first();
        $data = array(
            'user' => $user,
            'apiKeys' => $apiKeys
        );
        return view('profile', $data);
    }

    // TESTING FUNCTION
    public function encrypt() {
        $key  = 'That golden key that opes the palace of eternity.';
        $data = 'The chicken escapes at dawn. Send help with Mr. Blue.';
        $alg  = MCRYPT_BLOWFISH;
        $mode = MCRYPT_MODE_CBC;

        $iv = mcrypt_create_iv(mcrypt_get_iv_size($alg,$mode),MCRYPT_DEV_URANDOM);
        $encrypted_data = mcrypt_encrypt($alg, $key, $data, $mode, $iv);
        $plain_text = base64_encode($encrypted_data);

        print $plain_text."\n";
        $decoded = mcrypt_decrypt($alg,$key,base64_decode($plain_text),$mode,$iv);
        print $decoded."\n";
    }
}
