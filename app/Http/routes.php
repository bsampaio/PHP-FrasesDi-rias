<?php

use App\Models\Quote;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', ['uses' => 'App\Http\Controllers\QuotesController@home','as' => 'home']);

/**
 * Display a specific quote
 */
$app->get('/view/{id}', function($id) use ($app) {
    $quote = Quote::query()->findOrFail($id);
    return view('quote', ['quote' => $quote]);
});

$app->get('/new', ['as' => 'new',function() use($app) {
    return view('new');
}]);

$app->post('/new', ['uses' => 'App\Http\Controllers\QuotesController@save','as' => 'save']);