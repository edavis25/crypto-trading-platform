
function drawCandlestick(pair) {

    // Show loading icon
    $('#candlestick-chart').html('');
    $('#candlestick-overlay').show();
    
    //$.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-ohlcv.json&callback=?', function (data) {
    var query = "query?db=crypto&epoch=ms&q=SELECT * FROM poloniex WHERE pair='"+ pair +"' AND time >= now() - 60d";
    var url = 'http://192.168.0.101:8086/' + query;

    $.getJSON(url, function (data) {

        var columns = data['results'][0]['series'][0]['columns']
        var values = data['results'][0]['series'][0]['values'];

        // split the data set into ohlc and volume
        var ohlc = [],
        volume = [],
        //dataLength = data.length,
        dataLength = values.length;
            // set the allowed units for data grouping
            /*
            groupingUnits = [[
                'week',                         // unit name
                [1]                             // allowed multiples
                ], [
                'month',
                [1, 2, 3, 4, 6]
                ]],
            */
        groupingUnits = [[
            'minute',
            [5, 10, 15, 30]
        ], [
            'hour',
            [1, 2, 4]
        ], [
            'day',
            [1, 2, 4, 7]
        ]],

        i = 0;

        for (i; i < dataLength; i += 1) {
            //alert(values[i][0]); return;
            ohlc.push([
            /*
            data[i][0], // the date
            data[i][1], // open
            data[i][2], // high
            data[i][3], // low
            data[i][4] // close
            */

                parseInt(values[i][0]), // time
                parseFloat(values[i][4]), // open
                parseFloat(values[i][2]), // high
                parseFloat(values[i][3]), // low
                parseFloat(values[i][1])  // close
            ]);

            volume.push([
                //data[i][0], // the date
                //data[i][5] // the volume
                values[i][0], // time
                values[i][7]  // volume
            ]);  
        }

        // create the chart
        Highcharts.stockChart('candlestick-chart', {
            
            plotOptions: {
                candlestick: {
                    color: 'red',       // Down color
                    upColor: 'green',
                    pointWidth: 8
                }
            },

            // Range buttons (top left)
            rangeSelector: {
                buttonSpacing: 5,
                buttonTheme: {
                    width: null,
                    padding: 5
                },
                //allButtonsEnabled: true,
                buttons: [{
                    type: 'hour',
                    count: 6,
                    text: '5-min',
                    dataGrouping: {
                        forced: true,
                        units: [['minute', [5]]]
                    }
                }, {
                    type: 'day',
                    count: 2,
                    text: '30-min',
                    dataGrouping: {
                        forced: true,
                        units: [['minute', [30]]]
                    }
                }, {
                    type: 'day',
                    count: 7,
                    text: '2-hr',
                    dataGrouping: {
                        forced: true,
                        units: [['hour', [2]]]
                    }
                }, {
                    type: 'all',
                    //count: 6,
                    text: '1-day',
                    dataGrouping: {
                        forced: true,
                        units: [['day', [1]]]
                    }
                }],

                // Default button selection
                selected: 1
            },

            title: {
                text: pair.toUpperCase()
            },

            yAxis: [{
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'OHLC'
                },
                height: '60%',
                lineWidth: 2
            }, {
                labels: {
                    align: 'right',
                    x: -3
                },
                title: {
                    text: 'Volume'
                },
                top: '65%',
                height: '35%',
                offset: 0,
                lineWidth: 2
            }],

            tooltip: {
                valueDecimals: 8,
                split: true
            },

            series: [{
                type: 'candlestick',
                name: pair,
                data: ohlc,
                dataGrouping: {
                    units: groupingUnits
                }
            }, {
                type: 'column',
                name: 'Volume',
                data: volume,
                yAxis: 1,
                dataGrouping: {
                    units: groupingUnits
                }
            }]
        });

        // Hide loading icon
        $('#candlestick-overlay').hide();
    });
}
