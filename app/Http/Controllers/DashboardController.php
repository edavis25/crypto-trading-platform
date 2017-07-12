<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\poloniex\Poloniex;
use App\Libraries\influxdb\InfluxDB;

class DashboardController extends Controller
{
    public function index() {

        $this->getCurrentBtcPrice();
        // Create API objects
        $polo = new Poloniex(env('POLONIEX_API_KEY'), env('POLONIEX_API_SECRET'));
        $influx = new InfluxDB('crypto', 'http://192.168.0.101');


        $data = array(
            //'polo_tickers' => $polo -> get_ticker('all'),
            'polo_tickers' => $this -> formatTickerArray($polo -> get_ticker('all')),
            'polo_balances' => $polo -> get_available_balances(),
            //'polo_coin_info' => $polo -> get_currency_data(),
            'db_pairs' => $influx -> getTagValues('pair')
        );

        // Calculate/add total BTC balance
        $data['polo_total_btc'] = $this -> getTotalBtcBalance($data['polo_balances'], $data['polo_tickers']);

        return view('dashboard', $data);
    }


    // Split full ticker into array of arrays for each base trading pair
    // ex: array('BTC' => array(all BTC pairs), 'ETH' => array(all ETH pairs))
    // Used to separate trading pairs for the tabs on poloniex ticker tabbles
    private function formatTickerArray($allTickers) {
        // Outermost array (ex: data = array('BTC' => array(), 'USDT' => array()))
        $data = array();

        foreach($allTickers as $key=>$ticker) {
            // String manip to get base currency from a pair (ex: BTC_LTC -> BTC, USDT_BTC -> USDT)
            $delim = strpos($key, '_');
            $base = substr($key, 0, $delim);

            // Add the ticker as a new array value (it is currently the key)
            $ticker['pair'] = $key;

            // Add data to outer array under each base key
            // If the base key exists, push the current ticker data
            if (array_key_exists($base, $data)) {
                array_push($data[$base], $ticker);
            }
            else {
                // Else initialize a new array before pushing ticker data
                $data[$base] = array();
                array_push($data[$base], $ticker);
            }
        }
        return $data;
    }

    // Get the current Bitcoin price from coindesk
    // Accepts USD, GBP,& EUR
    private function getCurrentBtcPrice($currencyType = 'USD') {
        $url = 'http://api.coindesk.com/v1/bpi/currentprice.json';
        $data = json_decode(file_get_contents($url));
        $currency = $data->bpi->$currencyType;

        // Build formatted string for display (includes currency symbol)
        $str = $currency->symbol;
        $str .= substr($currency->rate, 0, -2);     // Discard last 2 decimal places
        return $str;
    }

    private function getTotalBtcBalance($balances, $tickers) {
        
        foreach ($balances as $balance) {
            
        }
    }
}
