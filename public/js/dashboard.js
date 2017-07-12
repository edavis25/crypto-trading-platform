$(document).ready(function() {
    var selected = $("#candlestick-select").val();
    drawCandlestick(selected);

    $('#candlestick-select').on('change', function() {
        drawCandlestick($(this).val());
    });

    // Sort all ticker tables by volume descending
    var tickerTables = document.getElementsByClassName('ticker-table');
    for (var i = 0; i < tickerTables.length; i++) {
        sortTableByColumn(tickerTables[i], 2, true);
    }
});

// ES6 supports default params
function sortTableByColumn(tableElement, columnNum, descending = false) {
    var column = tableElement.getElementsByTagName('th')[columnNum];
    // Sort column ascending
    sorttable.innerSortFunction.apply(column, []);
    // If descending desired, call method again (1 call = ascending sort)
    if (descending) {
        sorttable.innerSortFunction.apply(column, []);
    }
}

