@include('includes.header')
@include('includes.navigation')

<div class="row">
    <div class="container col-sm-8 col-sm-offset-2">
        <h1>User Profile</h1>
        <hr />
        <form class="form">
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
            <h3>API Keys</h3>
            <div class="form-group">
                <label class="control-label">Poloniex Key</label>
                <input class="form-control" type="text" />
            </div>
            <div class="form-group">
                <label class="control-label">Poloniex Secret</label>
                <input class="form-control" type="text" />
            </div>
        </form>
    </div>
</div>

@include('includes.footer')