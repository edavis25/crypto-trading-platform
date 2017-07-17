<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\poloniex\Poloniex;
use App\Libraries\influxdb\InfluxDB;

class DashboardController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        // Create API objects
        $polo = new Poloniex(env('POLONIEX_API_KEY'), env('POLONIEX_API_SECRET'));
        $influx = new InfluxDB('crypto', 'http://192.168.0.101');

        // Get all Poloniex tickers
        $poloTickers = $polo->get_ticker('all');
        $poloBalances = $this->formatPoloBalances($polo->get_available_balances());

        $data = array(
            'btc_price' => $this->getBTC_USDT($poloTickers),
            'polo_tickers' => $this->formatTickerArray($poloTickers),
            //'polo_balances' => $this->formatPoloBalances($poloBalances),
            //'polo_coin_info' => $polo -> get_currency_data(),
            'db_pairs' => $influx -> getTagValues('pair')
        );

        // Calculate/add total BTC balance
        $data['polo_total_btc'] = $this -> getTotalBtcBalancePoloniex($poloBalances, $poloTickers);
        $data['total_dollar_value'] = number_format(($data['polo_total_btc']) * $data['btc_price'], 2, '.', ',');

        return view('dashboard', $data);
    }

    private function formatBalanceArray($balances, $tickers) {
        $arr = array();
        print_r($balances); die;
    }

    // Combine all polo balances into 1 balance per coin 
    // Currently there are separate balances for exchange, margin, and lending
    // This sums them all into a single balance for each coin
    private function formatPoloBalances($balances) {
        $arr = array();
        foreach ($balances as $exchange) {
            foreach ($exchange as $key=>$balance) {
                if (array_key_exists($key, $arr)){
                    $arr[$key] += $balance;    
                }
                else {
                    $arr[$key] = $balance;
                }
            }
        }        
        return $arr;
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


    // Get BTC price in dollars based on USDT
    private function getBTC_USDT($tickers) {
        return number_format($tickers['USDT_BTC']['last'], 2, '.', '');
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


    private function getTotalBtcBalancePoloniex($balances, $tickers) {
        $amount = 0;
        // Iterate each exchange type (exchange/margin/lending)
        foreach ($balances as $exchange) {
            // Iterate each currency balance per exchange
            foreach ($exchange as $key=>$balance) {
                // Get bitcoin value and add to amount
                if ($key == 'BTC') {
                    $amount += $balance;
                    continue;
                }

                $price = $tickers['BTC_' . $key]['last'];
                $btcVal = number_format($price * $balance, 8);
                $amount += $btcVal;
            }
        }
        return $amount;
    }
}
