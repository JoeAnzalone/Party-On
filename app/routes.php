<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login', ['as' => 'user.show_login', 'uses' => 'UsersController@showLogin']);
Route::post('login', ['as' => 'user.do_login', 'uses' => 'UsersController@login']);
Route::any('logout', ['as' => 'user.logout', 'uses' => 'UsersController@logout']);

Route::get('event/mine', ['as' => 'event.mine', 'uses' => 'EventsController@currentUser']);

Route::resource('event', 'EventsController');
Route::resource('guests', 'GuestsController');

Route::any('{key}/{slug?}', ['as' => 'event.showbykey', 'uses' => 'EventsController@showByGuestKey']);

Route::any('{key}/rsvp/{response}', ['as' => 'guest.edit_response', 'uses' => 'GuestsController@editResponse']);
