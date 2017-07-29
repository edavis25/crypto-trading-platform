@extends('layouts.layout')

@section('title', 'Alert Subscriptions')

@section('content')
    
    <div class="row">
        <div class="container col-sm-8 col-sm-offset-2">
            <h1>Manage Alert Subscriptions</h1>
            <hr>
            <h2>My Subscriptions</h2>
            <form class="form form-horizontal container-fluid" id="subscribed-form">
                <div class="row">
                    @foreach($subscribed as $pair)
                    <div class="form-group col-sm-6 col-md-4">
                        <input class="checkbox-inline" type="checkbox" name="{{ $pair->pair }}" id="{{ $pair->pair }}-id">
                        <label for="{{ $pair->pair }}-id">{{ $pair->pair }}</label>
                    </div>
                    @endforeach
                </div>        
            </form>

            <hr>
            <h2>Unsubscribed</h2>
            <form class="form form-horizontal container-fluid" id="subscribed-form">
                <div class="row">
                    @foreach($unsubscribed as $pair)
                    <div class="form-group col-sm-6 col-md-4">
                        <input class="checkbox-inline" type="checkbox" name="{{ $pair->pair }}" id="{{ $pair->pair }}-id">
                        <label for="{{ $pair->pair }}-id">{{ $pair->pair }}</label>
                    </div>
                    @endforeach
                </div>        
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Pair</th>
                            <th>Arbitrage</th>
                            <th>Volume</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div> <!-- End Responsive Table -->
        </div>
    </div>

@endsection