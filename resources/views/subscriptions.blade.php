@extends('layouts.layout')

@section('title', 'Alert Subscriptions')

@section('styles')
    @parent
    <link href="{{ URL::asset('vendor/bootstrap-switch.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="container col-sm-8 col-sm-offset-2">
            <h1>Manage Alert Subscriptions</h1>
            <p>
                Set the trading pairs for which you will receive alerts. All of the pairs for which you are currently
                receiving alerts can be found under the "My Subscriptions" section. 
                <br>To add and remove subscriptions simply flip the toggle switches next to the desired trading pair.
            </p>
            <p>
                <i>Note: Don't forget to save any changes you have made!</i>
            </p>
            <form method="POST" action="{{ URL::to('subscriptions/update') }}" class="form form-horizontal container-fluid" id="subscribed-form">
                <div class="row">
                    <input type="submit" class="btn btn-success" value="Save Changes" />
                    <input type="reset" class="btn btn-danger" value="Reset" />
                </div>
                <hr>
                <div class="row">
                    <h3>My Subscriptions</h3>
                    @foreach($subscribed as $pair)
                    <div class="form-group col-sm-6 col-md-4">
                        <input class="checkbox-inline switch" type="checkbox" name="subscribed[{{ $loop->index }}]" value="{{ $pair->id }}" id="{{ $pair->pair }}-id" checked="checked">
                        <label for="{{ $pair->pair }}-id" class="alert-switch-label">{{ $pair->pair }}</label>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <h3>Unsubscribed</h3>
                    @foreach($unsubscribed as $pair)
                    <div class="form-group col-sm-6 col-md-4">
                        <input class="checkbox-inline switch" type="checkbox" name="unsubscribed[{{ $loop->index }}]" value="{{ $pair->id }}" id="{{ $pair->pair }}-id">
                        <label for="{{ $pair->pair }}-id" class="alert-switch-label">{{ $pair->pair }}</label>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <br>
                    <input type="submit" class="btn btn-success" value="Save Changes" />
                    <input type="reset" class="btn btn-danger" value="Reset" />
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
    <br><br><br>

@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('vendor/bootstrap-switch.min.js') }}"></script>

    <!-- Initialize checkbox switches -->
    <script>
        $.fn.bootstrapSwitch.defaults.size = 'mini';
        $('.switch').bootstrapSwitch();
    </script>
@endsection