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

Route::get('/home', 'StatusController@viewStatus')->name('home');
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('/events', 'HomeController@showEvents')->name('events');

//Route for register in events
Route::post('/events/register-event/{id}', 'EventsController@registerEvent')->name('register-event');

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
Route::get('/', 'EventsController@manageEvents')->name('manage-events');
//Route for adding Event
Route::get('/add-event', 'EventsController@addEvents')->name('add-event');
Route::post('/add-event', 'EventsController@addEventsPost');
//Route for Delete Event Function
Route::post('/delete/{id}', 'EventsController@deleteEvents')->name('delete-event');
//Route for Edit Event View
Route::get('/edit/{id}', 'EventsController@editEvents')->name('edit-event');
//Route edit Event function
Route::post('/edit/{id}', 'EventsController@editEventsPost')->name('edit-event-post');

}); // closing events

//All of the routes here will be having /manage-status/"route name"
Route::prefix('/manage-status')->group(function(){
//Route for viewing status
Route::get('/', 'StatusController@manageEvent')->name('manage-status');
//Route for adding status
Route::post('/add-status', 'StatusController@addStatus')->name('add-status');
//Route for Delete status Function
Route::post('/delete/{id}', 'StatusController@deleteStatus')->name('delete-status');
//Route for Edit status View
Route::get('/edit/{id}', 'StatusController@editStatus')->name('edit-status');
//Route edit status function
Route::post('/edit/{id}', 'StatusController@editStatusPost')->name('edit-status-post');
//Route for View status View
Route::post('/add-comment/{id}', 'CommentsController@addComment')->name('add-comment');
}); // closing [post]

}); // closing dashboard
