<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/inbox','MessagesController@messages')->name('inbox.messages');

// ...lostitem route
Route::post('/lostitem/store', 'LostitemController@store')->name('lostitem.store');
Route::get('/lostitem/create', 'LostitemController@create')->name('lostitem.create');
Route::get('/lostitem', 'Lostitem2Controller@index')->name('lostitem.index');
Route::get('/lostitem/{lostitem}','LostitemController@show')->name('lostitem.show');

// ...founditem route
Route::post('/founditem/store', 'FounditemController@store')->name('founditem.store');
Route::get('/founditem/create', 'FounditemController@create')->name('founditem.create');
Route::get('/founditem', 'Founditem2Controller@index')->name('founditem.index');
Route::get('/founditem/{founditem}','FounditemController@show')->name('founditem.show');

// ...profile route

Route::get('/profile', 'profileController@index')->name('profile');
Route::post('/profile/update', 'profileController@updateProfile')->name('profile.update');
Route::delete('/deleted/{lostitem}','profileController@destory');
Route::delete('/delete/{founditem}','profileController@destory2');


Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages');
Route::post('/send', 'MessagesController@postSendMessage');
Route::get('/fetch-old-messages', 'MessagesController@getOldMessages');
// Route::get('/home', function () {
//     return view('welcome');
// })->name('home');

// contact
Route::get('contact-us', 'ContactController@getContact');
Route::post('contact-us', 'ContactController@saveContact');


