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

Route::get('/home', 'PostsController@home')->name('home');
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


}); // closing dashboard

Route::post('/createpost', 'PostsController@postCreatePost')->name('post.create');
Route::get('/delete-post/{post_id}', 'PostsController@getDeletePost')->name('post.delete');

Route::post('/edit', [
    'uses' => 'PostsController@postEditPost',
    'as' => 'edit',
    'middleware' => 'auth'
]);

Route::post('/like/{id}', [
    'uses' => 'PostsController@postLikePost',
    'as' => 'like',
    'middleware' => 'auth'
]);

Route::post('/createcomment', [
   'uses' => 'PostsController@postCreateComment',
   'as' => 'comment.create',
   'middleware' => 'auth'
]);

Route::get('/postimage/{filename}', [
    'uses' => 'PostsController@getPostImage',
    'as' => 'post.image',
    'middleware' => 'auth'
]);

Route::get('/users/{user_id}', [
  'uses' => 'PostsController@getUserPage',
  'as' => 'userpage',
  'middleware' => 'auth'
]);

Route::get('/delete-post/{post_id}', [
    'uses' => 'PostsController@getDeletePost',
    'as' => 'post.delete',
    'middleware' => 'auth'
]);

Route::post('/edit', [
    'uses' => 'PostsController@postEditPost',
    'as' => 'edit',
    'middleware' => 'auth'
]);

//All of the routes here will be having /manage-events/"route name"
Route::prefix('/manage-profile')->group(function(){
//Route for viewing Event
Route::get('/', 'ProfileController@manageEvents')->name('manage-events');
//Route for Edit Event View
Route::get('/edit/{id}', 'ProfileController@editProfile')->name('edit-profile');
//Route edit Event function
Route::post('/edit/{id}', 'ProfileController@editProfilePost')->name('edit-profile-post');

}); // closing events