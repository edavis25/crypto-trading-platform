<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        {{-- Yield content for the page's title --}}
        <title>@yield('title')</title>


        {{-- 
           - Create a section for default styles that will be needed by all pages.
           - This allows each page to add any other styles they may need to cut down on the
           - total number of loads when not needed when appeding scripts inside a child section 
           - you must call the parent w/ @parent
        --}}

        @section('styles')
            <!-- Bootstrap Core CSS -->
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

            <!-- MetisMenu CSS -->
            <link href="{{ URL::asset('vendor/metisMenu.min.css') }}" rel="stylesheet">

            <!-- Theme CSS -->
            <link href="{{ URL::asset('css/sb-admin-2.css') }}" rel="stylesheet">

            <!-- Morris Charts CSS -->
            <link href="{{ URL::asset('vendor/morris.css') }}" rel="stylesheet">

            <!-- Font Awesome -->
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

            <!-- Custom CSS -->
            <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->
        @show

    </head>

    <body>

        <!-- Main wrapper closed in footer file -->
        <div id="wrapper" class="container-fluid">

            {{-- Add navigation section --}}

            @section('navigation')
                @include('layouts.navigation')
            @show


            {{-- Yield to page content --}}

            @yield('content')

        </div> <!-- End main wrapper opened in header file -->


        {{-- 
           - Create a section for default scripts that will be needed by all pages.
           - This allows each page to add any other scripts they may need to cut down on the
           - total number of script loads when not needed (ie. Highcharts isn't always needed).
           - Make sure when appeding scripts inside a child section that you call the parent w/ @parent
        --}}

        @section('scripts')
            <!-- Bootstrap Core JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="{{ URL::asset('vendor/metisMenu.min.js') }}"></script>

            <!-- MARKED FOR REMOVAL -->
            <!-- Morris Charts JavaScript -->
            <script src="{{ URL::asset('vendor/raphael.js') }}"></script>
            <script src="{{ URL::asset('vendor/morris.min.js') }}"></script>
            <script src="{{ URL::asset('vendor/morris-data.js') }}"></script>

            <!-- Theme JavaScript -->
            <script src="{{ URL::asset('js/sb-admin-2.min.js') }}"></script>       
        @show

    </body>
</html>