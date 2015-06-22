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

function rest($path, $controller){
	global $app;

	$app->get($path.'/randomize', $controller.'@randomize');
	$app->get($path.'/randomize/{id}', $controller.'@randomize');
	$app->post($path.'/up/{id}', $controller.'@up');
	$app->post($path.'/down/{id}', $controller.'@up');
	$app->post($path.'/save', $controller.'@save');
}

rest('/rest','App\Http\Controllers\QuotesControllerRest');

/**
 * Get routes
 */
$app->get('/iframe', ['uses' => 'App\Http\Controllers\QuotesController@iframe','as' => 'iframe']);
$app->get('/randomize/{id}', ['uses' => 'App\Http\Controllers\QuotesController@randomize','as' => 'randomize']);
$app->get('/new', ['uses' => 'App\Http\Controllers\QuotesController@loadNew','as' => 'new']);

/**
 * Post routes
 */

$app->post('/new', ['uses' => 'App\Http\Controllers\QuotesController@save','as' => 'save']);
$app->post('/up/{id}', ['uses' => 'App\Http\Controllers\QuotesController@up', 'as' => 'up']);
$app->post('/down/{id}', ['uses' => 'App\Http\Controllers\QuotesController@down', 'as' => 'down']);