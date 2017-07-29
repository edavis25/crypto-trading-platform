<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlertSubscriptionsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function view_subscriptions() {
        $user = Auth::user();
        $allPairs = DB::table('pairs')->get();

        $subscribed = DB::table('pairs')
                          ->join('user_subscriptions', 'pairs.id', '=', 'user_subscriptions.pair_id')
                          ->select('pairs.pair')
                          ->where('user_id', '=', $user->id)
                          ->get();

        $unsubscribed = DB::table('pairs')
                            ->select('pair')
                            ->whereNotIn('id', function($query) use ($user) {
                                $query->select('pair_id')
                                      ->from('user_subscriptions')
                                      ->where('user_id', '=', $user->id);
                            })
                            ->get();

        $data = array(
            'all_pairs' => $allPairs,
            'subscribed' => $subscribed,
            'unsubscribed' => $unsubscribed
        );
        //var_dump($data['unsubscribed']); die;
        return view('subscriptions', $data);
    }
}
