<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Request;

class AlertSubscriptionsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function view() {
        $user = Auth::user();
        $allPairs = DB::table('pairs')->get();

        $subscribed = DB::table('pairs')
                          ->join('user_subscriptions', 'pairs.id', '=', 'user_subscriptions.pair_id')
                          ->select('pairs.id', 'pairs.pair')
                          ->where('user_id', '=', $user->id)
                          ->get();

        $unsubscribed = DB::table('pairs')
                            ->select('id', 'pair')
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

    public function update() {

        $user = Auth::user();

        // Get selection arrays from POST (set to empty array if nothing is selected instead of default NULL)
        $subscribed = Request::input('subscribed') ? Request::input('subscribed') : array();
        $unsubscribed = Request::input('unsubscribed') ? Request::input('unsubscribed') : array();

        //Merge both arrays to find all user selections
        $selections = array_merge($subscribed, $unsubscribed);

        // Delete current subscriptions in database
        DB::table('user_subscriptions')->where('user_id', '=', $user->id)->delete();

        // Build DB insert statement array
        $insertData = array();
        // Iterate each selection for a single insert statement and add to insert array
        foreach ($selections as $selection) {
            $insertStatement = array(
                'user_id' => $user->id,
                'pair_id' => $selection,
                'type_id' => 1         // **** NOTE: This (1) is a hardcoded value for arbitrage alert. It will
            );                         // need changed when customization for different alert types is added ****

            // Add insert statement to data array
            $insertData[] = $insertStatement;
        }

        // Insert the new subscriptions
        DB::table('user_subscriptions')->insert($insertData);

        // Navigate back to subscriptions page
        return redirect()->route('subscriptions');
    }
}
