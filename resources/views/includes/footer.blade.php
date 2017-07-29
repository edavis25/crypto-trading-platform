<!-- 
   - NOTE: This file has now been refactored to use Blade's templating features and
   - should no longer be needed. Delete this file once the new refactor has undergone
   - appropriate testing to make sure it works! 
-->


        </div> <!-- End main wrapper opened in header file -->

        <!-- Bootstrap Core JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ URL::asset('vendor/metisMenu.min.js') }}"></script>

        <!-- Morris Charts JavaScript -->
        <script src="{{ URL::asset('vendor/raphael.js') }}"></script>
        <script src="{{ URL::asset('vendor/morris.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/morris-data.js') }}"></script>

        <!-- Highcharts CDN -->
        <script src="https://code.highcharts.com/stock/highstock.js"></script>
        <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

        <!-- Sorttable tables plugin -->
        <script src="{{ URL::asset('vendor/sorttable.js') }}"></script>

        <!-- Theme JavaScript -->
        <script src="{{ URL::asset('js/sb-admin-2.min.js') }}"></script>

        <!-- Custom JavaScript -->
        <script src="{{ URL::asset('js/candlestick.js') }}"></script>
        <script src="{{ URL::asset('js/dashboard.js') }}"></script>
    </body>
</html>