@include('includes.header')
@include('includes.navigation')

<div class="row">
    <div class="container col-sm-8 col-sm-offset-2">
        <h1>User Profile</h1>
        <hr />
        <form class="form col-xs-12">
            <h3>User Info</h3>
            <div class="form-group">
                <label class="control-label">Name</label>
                <input class="form-control" type="text" value="{{ $user->name }}" />
            </div>
            <div class="form-group">
                <label class="control-label">Email</label>
                <input class="form-control" type="email" value="{{ $user->email }}" />
            </div>
            <hr />
        </form>
        <div class="container col-xs-12">
            <div class="row">
                <div class="container col-xs-12">
                    <h3>API Keys</h3>
                </div>
            </div>
            <div class="row">
                <div class="container col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Poloniex</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-5 text-center">
                                <div class="row">
                                    @if ($apiKeys->poloniex_key)
                                        <i class="fa fa-check fa-4x green" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-times fa-4x red" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="row">
                                    <h4><b>Key</b></h4>
                                </div>
                            </div>
                            <div class="col-xs-6 col-xs-offset-1 text-center">
                                <div class="row">
                                    @if ($apiKeys->poloniex_secret)
                                        <i class="fa fa-check fa-4x green" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-times fa-4x red" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="row">
                                    <h4><b>Secret</b></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Bittrex</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-5 text-center">
                                <div class="row">
                                    @if ($apiKeys->bittrex_key)
                                        <i class="fa fa-check fa-4x green" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-times fa-4x red" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="row">
                                    <h4><b>Key</b></h4>
                                </div>
                            </div>
                            <div class="col-xs-6 col-xs-offset-1 text-center">
                                <div class="row">
                                    @if ($apiKeys->bittrex_secret)
                                        <i class="fa fa-check fa-4x green" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-times fa-4x red" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="row">
                                    <h4><b>Secret</b></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container col-sm-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Bitfinex</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-5 text-center">
                                <div class="row">
                                    @if ($apiKeys->bitfinex_key)
                                        <i class="fa fa-check fa-4x green" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-times fa-4x red" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="row">
                                    <h4><b>Key</b></h4>
                                </div>
                            </div>
                            <div class="col-xs-6 col-xs-offset-1 text-center">
                                <div class="row">
                                    @if ($apiKeys->bitfinex_secret)
                                        <i class="fa fa-check fa-4x green" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-times fa-4x red" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="row">
                                    <h4><b>Secret</b></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('includes.footer')