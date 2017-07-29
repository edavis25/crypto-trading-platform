<?php

// TODO: Refactor account balances functions to combine and format
// balances into a single array for easy display within view.

// NOTE: Don't forget there is a 6 call/second limit to the Poloniex API

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\poloniex\Poloniex;
use App\Libraries\influxdb\InfluxDB;

class DashboardController extends Controller
{

    private $polo;
    private $influx;
    private $btcPrice;

    public function __construct() {
        $this->middleware('auth');
        $this->polo = new Poloniex(env('POLONIEX_API_KEY'), env('POLONIEX_API_SECRET'));
        $this->influx = new InfluxDB('crypto', 'http://192.168.0.101');
        $this->btcPrice = $this->getCurrentBtcPrice();
    }

    public function index() {

        // Create API objects
        //$polo = new Poloniex(env('POLONIEX_API_KEY'), env('POLONIEX_API_SECRET'));
        //$influx = new InfluxDB('crypto', 'http://192.168.0.101');

        // Make all Poloniex API calls (performed here so I can keep track of all calls)
        $poloTickers = $this->polo->get_ticker('all');
        $poloBalances = $this->polo->get_available_balances();
        $poloOpenOrders = $this->polo->get_open_orders('all');
        $poloOrderBook = $this->polo->get_order_book('all');
        $poloTradeHistory = $this->polo->get_my_trade_history('all');
        
        $data = array(            
            'btc_price' => $this->btcPrice,
            'polo_tickers' => $this->formatTickerArray($poloTickers),
            //'polo_balances' => $this->formatPoloBalances($poloBalances),
            'polo_balances' => $this->formatPoloBalances($poloBalances, $poloTickers),
            'polo_total_btc' => $this->getTotalBtcBalancePolo($poloBalances, $poloTickers),
            //'polo_coin_info' => $polo -> get_currency_data(),
            'db_pairs' => $this->influx->getTagValues('pair'),
            'open_orders' => $poloOpenOrders,
            'number_open_orders' => $this->countOpenOrders($poloOpenOrders),
            'polo_trade_history' => $poloTradeHistory
        );
				
        // Calculate/add total BTC balance
        //$data['polo_total_btc'] = $this -> getTotalBtcBalancePoloniex($poloBalances, $poloTickers);
        $data['total_dollar_value'] = number_format(($data['polo_total_btc']) * $this->btcPrice, 2, '.', ',');
        return view('dashboard', $data);
    }

    // Combine all polo balances into 1 balance per coin 
    // Currently there are separate balances for exchange, margin, and lending
    // This sums them all into a single balance for each coin
    private function combinePoloBalances($balances) {
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

    private function countOpenOrders($orders) {
        $count = 0;
        foreach ($orders as $order) {
            $count += count($order);
        }
        return $count;
    }

    private function formatPoloBalances($balances, $tickers) {
        $balances = $this->combinePoloBalances($balances);  // Combine balances
        $arr = array();

        foreach($balances as $key=>$balance) {

            if ($key == 'BTC') {
                $btcValue = $balance;
            }
            else {
                $btcValue = $tickers['BTC_' . strtoupper($key)]['last'] * $balance;
            }

            $arr[$key] = array(
                'amount' => $balance,
                'btc_value' => number_format($btcValue, 8, '.', ''),
                'usd_value' => number_format($btcValue * $this->btcPrice, 2, '.', ',')
            );
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

        // Get price and format into currency format w/o commas
        $price = $currency->rate;
        $price = str_replace(',', '', $price);         // Strip commas
        return number_format($price, 2, '.', '');
    }


    private function getTotalBtcBalancePolo($balances, $tickers) {
        $amount = 0; 
        $balances = $this->combinePoloBalances($balances);  // Combine balances

        foreach ($balances as $key=>$balance) {
            // Get bitcoin value and add to amount
            if ($key == 'BTC') {
                $amount += $balance;
                continue;
            }

            $price = $tickers['BTC_' . $key]['last'];
            $btcVal = number_format($price * $balance, 8);
            $amount += $btcVal;
        }

        return $amount;
    }
}
