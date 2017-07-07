<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('email', function() {
	Artisan::call('email:send');
});


Artisan::command('scrape_recent', function() {
	Artisan::call('scrape_recent:scrape');
});

Artisan::command('scrape', function() {
	Artisan::call('scrape:recent');
});