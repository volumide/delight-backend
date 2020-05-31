<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Blog api
Route::post('create/blog', 'BlogController@newBlog');
Route::put('update/blog/{id}', 'BlogController@editBlog');
Route::delete('delete/blog/{id}', 'BlogController@removeBlog');	
Route::get('all/blog', 'BlogController@getAllBlog');
Route::get('blog/{id}', 'BlogController@getblog');

// leaders api
Route::post('create/leader/profile', 'LeadersController@createLeaderProfile');
Route::put('update/leader/profile/{id}', 'LeadersController@updateLeaderProfile');
Route::delete('remove/leader/profile/{id}', 'LeadersController@removeLeaderProfile');
Route::get('get/leaders', 'LeadersController@getLeaders');
Route::get('get/leader/profile/{id}', 'LeadersController@getLeaderProfile');

// Events api
Route::post('create/event', 'EventController@newEvent');
Route::delete('remove/event/{id}', 'EventController@removeEvent');
Route::put('update/event/{id}', 'EventController@editEvent');
Route::get('all/event', 'EventController@getAllEvents');
Route::get('event/{id}', 'EventController@getEvent');

// Comment api
Route::post('create/comment', 'CommentController@newComment');
Route::delete('remove/comment/{id}', 'CommentController@removeComment');
Route::get('all/comments', 'CommentController@getAllComment');

//id is based on blog id
Route::get('get/comment/{id}', 'CommentController@getComment');

// Email route
Route::post('subscribe/to/mailing/list', 'EmailController@subscribeToMailList');
Route::delete('unsubscribe/from/mailing/list', 'EmailController@unsubscribeFromMail');
Route::post('send/mail/to/subscribers', 'EmailController@sendMail');

// count all database 
Route::get('count', 'BlogController@dataCount');
Route::post('upload/image', 'BlogController@uploadImage');
Route::post('upload/image/option', 'BlogController@uploadFile');
