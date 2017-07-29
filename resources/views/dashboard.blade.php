@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-5x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">${{ $total_dollar_value }}</div>
                                <div>Portfolio Value</div>
                            </div>
                        </div>
                    </div>
                    <a href="###" data-toggle="modal" data-target="#balances-modal" role="dialog">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $number_open_orders }}</div>
                                <div>Open Positions</div>
                            </div>
                        </div>
                    </div>
                    <a href="###" data-toggle="modal" data-target="#orders-modal" role="dialog">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-history fa-5x" aria-hidden="true"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    @if ($polo_trade_history)
                                        {{ count($polo_trade_history) }}
                                    @else 
                                        {{ 0 }}
                                    @endif
                                </div>
                                <div>Recent Trades</div>
                            </div>
                        </div>
                    </div>
                    <a href="###" data-toggle="modal" data-target="#recent-trades-modal" role="dialog">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">13</div>
                                <div>Support Tickets!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Last 60 Days
                        <div class="pull-right">
                            <div class="btn-group" style='bottom: 6px'>
                                <select id='candlestick-select'>
                                    @foreach ($db_pairs as $pair)
                                        <option value='{{ $pair }}'>{{ strtoupper($pair) }}</option>
                                    @endforeach
                                </select>
                                <!-- button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    Select Trading Pair
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu" style='height: 200px; overflow-y: auto'>
                                    @foreach ($db_pairs as $pair)
                                        <li>{{ $pair }}</li>
                                    @endforeach
                                </ul -->
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <!-- div id="morris-area-chart"></div -->
                        <span id="candlestick-overlay">
                            Loading chart...<i class="fa fa-refresh fa-spin fa-5x fa-fw" id="candlestick-refresh-icon"></i>
                        </span>
                        <div id="candlestick-chart" style="height: 450px; min-width: 310px"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Bar Chart Example
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    Actions
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="#">Action</a>
                                    </li>
                                    <li><a href="#">Another action</a>
                                    </li>
                                    <li><a href="#">Something else here</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>3326</td>
                                                <td>10/21/2013</td>
                                                <td>3:29 PM</td>
                                                <td>$321.33</td>
                                            </tr>
                                            <tr>
                                                <td>3325</td>
                                                <td>10/21/2013</td>
                                                <td>3:20 PM</td>
                                                <td>$234.34</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.col-lg-4 (nested) -->
                            <div class="col-lg-8">
                                <div id="morris-bar-chart"></div>
                            </div>
                            <!-- /.col-lg-8 (nested) -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-clock-o fa-fw"></i> Responsive Timeline
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <ul class="timeline">
                            <li>
                                <div class="timeline-badge"><i class="fa fa-check"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago via Twitter</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero laboriosam dolor perspiciatis omnis exercitationem. Beatae, officia pariatur? Est cum veniam excepturi. Maiores praesentium, porro voluptas suscipit facere rem dicta, debitis.</p>
                                    </div>
                                </div>
                            </li>  
                            <li class="timeline-inverted">
                                <div class="timeline-badge info"><i class="fa fa-save"></i>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae consequuntur impedit nulla qui! Laborum, atque.</p>
                                        <hr>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-gear"></i> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Action</a>
                                                </li>
                                                <li><a href="#">Another action</a>
                                                </li>
                                                <li><a href="#">Something else here</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li><a href="#">Separated link</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam. Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->

            <!-- Right sidebar info -->
            <div class="col-lg-4">

                <!-- Ticker panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-exchange" aria-hidden="true"></i> Market Tickers
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div>
                            <ul class="nav nav-pills">
                                @foreach ($polo_tickers as $key=>$ticker)
                                    <li class="ticker-pair-button {{ $loop->first ? 'active' : '' }}"><a data-toggle="pill" href="#{{ $key }}">{{ $key }}</a></li>
                                @endforeach
                            </ul>
                            
                            <div class="tab-content">
                            <!-- Create tab content for each base pair (ex: BTC, USDT, etc.) -->
                                @foreach ($polo_tickers as $key=>$ticker)
                                    <div id="{{ $key }}" class="tab-pane fade {{ $loop->first ? 'in active' : '' }}">
                                        <div class="table-responsive" style="height: 400px; overflow-y: auto;">
                                            <table class="table table-bordered table-hover table-striped sortable ticker-table" id="{{ $key }}-table">
                                                <thead>
                                                    <tr>
                                                        <th>Pair</th>
                                                        <th>Price</th>
                                                        <th>Volume</th>
                                                        <th>Change</th>
                                                        <th>24hr High</th>
                                                        <th>24hr Low</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Populate table data for each pair -->
                                                    @foreach ($ticker as $pair)
                                                        <tr>
                                                            <td>{{ $pair['pair'] }}</td>
                                                            <td>{{ $pair['last'] }}</td>
                                                            <td>{{ number_format($pair['baseVolume'], 2) }}</td>
                                                            <td>{{ number_format($pair['percentChange'] * 100, 2) }}%</td>
                                                            <td>{{ $pair['high24hr'] }}</td>
                                                            <td>{{ $pair['low24hr'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- CONTENT REMOVED HERE -->

                        <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- End ticker panel -->


                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
                    </div>
                    <div class="panel-body">
                        <div id="morris-donut-chart"></div>
                        <a href="#" class="btn btn-default btn-block">View Details</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <div class="chat-panel panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments fa-fw"></i> Chat
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu slidedown">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-refresh fa-fw"></i> Refresh
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-check-circle fa-fw"></i> Available
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-times fa-fw"></i> Busy
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-clock-o fa-fw"></i> Away
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <ul class="chat">
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                        </small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                    <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong>
                                        <small class="pull-right text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted">
                                            <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.panel-body -->
                    <div class="panel-footer">
                        <div class="input-group">
                            <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" id="btn-chat">
                                    Send
                                </button>
                            </span>
                        </div>
                    </div>
                    <!-- /.panel-footer -->
                </div>
                <!-- /.panel .chat-panel -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->

        <!-- Balance Details Modal -->
        <div id="balances-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Current Balances</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>Coin</td>
                                        <td>Holdings</td>
                                        <td>BTC Value</td>
                                        <td>USD Value</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($polo_balances as $key=>$balances)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $balances['amount'] }}</td>
                                        <td>{{ $balances['btc_value'] }}</td>
                                        <td>${{ $balances['usd_value'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders modal -->
        <div id="orders-modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Open Positions</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="positions-table">
                                <thead>
                                    <tr>
                                        <td>Date</td>
                                        <td>Pair</td>
                                        <td>Amount</td>
                                        <td>Rate</td>
                                        <td>Total</td>
                                        <td>Type</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($open_orders as $key=>$order)
                                    
                                        @foreach ($order as $detail)
                                        <tr>
                                        <td>{{ $detail['date'] }}</td>
                                        <td>{{ $key }}</td>
                                        <td>{{ $detail['amount'] }}</td>
                                        <td>{{ $detail['rate'] }}</td>
                                        <td>{{ $detail['total'] }}</td>
                                        <td>{{ ($detail['margin']) ? 'Margin' : 'Exchange' }}
                                        </tr>
                                        @endforeach
                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Trades Modal -->
        <div id="recent-trades-modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Recent Trades (Last 24 hours)</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>Date</td>
                                        <td>Pair</td>
                                        <td>Rate</td>
                                        <td>Amount</td>
                                        <td>Total</td>
                                        <td>Type</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @if ($polo_trade_history)
                                @foreach ($polo_trade_history as $key=>$trades)
                                    @foreach ($trades as $trade)
                                    <tr>
                                        <td>{{ $trade['date'] }}</td>
                                        <td>{{ $key }}</td>
                                        <td>{{ $trade['rate'] }}</td>
                                        <td>{{ $trade['amount'] }}</td>
                                        <td>{{ $trade['total'] }}</td>
                                        <td>{{ $trade['type'] }}</td>
                                    </tr>
                                    @endforeach
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /#page-wrapper -->
@endsection {{-- End 'content' section --}}

{{-- Append scripts needed by dashboard --}}
@section('scripts')
    
    @parent

    <!-- Highcharts CDN -->
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

    <!-- Sorttable tables plugin -->
    <script src="{{ URL::asset('vendor/sorttable.js') }}"></script>

    <!-- Custom JavaScript -->
    <script src="{{ URL::asset('js/candlestick.js') }}"></script>
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>

@endsection