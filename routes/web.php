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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

//All of the routes here will be having /dashboard/"route name"
Route::prefix('/dashboard')->group(function(){

//All of the routes here will be having /manage-users/"route name"
Route::prefix('/manage-users')->group(function(){

//Route for Manage Users
Route::get('/', 'UsersController@manageUsers')->name('manage-users');
//Route for Edit User View
Route::get('/edit/{id}', 'UsersController@editUser')->name('edit-user');
//Route for Edit User Function
Route::post('/edit/{id}', 'UsersController@editUserPost')->name('edit-user-post');
//Route for Delete User Function
Route::post('/delete/{id}', 'UsersController@deleteUser')->name('delete-user');

//Route for Add Users Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

}); //closing manage users

//All of the routes here will be having /manage-events/"route name"
Route::prefix('/manage-events')->group(function(){
//Route for viewing Event
Route::get('/', 'EventsController@manageEvent')->name('manage-event');
//Route for adding Event
Route::get('/add-event', 'EventsController@addEvent')->name('add-event');
Route::post('/add-event', 'EventsController@addEventFunc');
//Route for Delete Event Function
Route::post('/delete/{id}', 'EventsController@deleteEvent')->name('delete-event');
//Route for Edit Event View
Route::get('/edit/{id}', 'EventsController@editEvent')->name('edit-event');
//Route edit Event function
Route::post('/edit/{id}', 'EventsController@editEventPost')->name('edit-event-post');

}); // closing events

}); // closing dashboard
