<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/', function () {
    return view('home');
})->name("home");






Route::get('/newpublication', function () {
    return view('newpublication');
})->name("newpublication");

Route::get('/login', function () {
    return view('loginuser');
})->name("loginuser");

Route::post('/login/submit', 'App\Http\Controllers\Auth\AuthenticatedSessionController@store')->name("log-form");

Route::get('/registration', function () {
    return view('registration');
})->name("registration");




Route::post('/registration/submit', 'App\Http\Controllers\Auth\RegisteredUserController@store')->name("reg-form");

Route::post('/newpublication/submit', 'App\Http\Controllers\NewPost@newpost')->name("newpub-form");
Route::post('/newcomment/submit', 'App\Http\Controllers\CommentsController@newcomment')->name("newcomment-form");
Route::post('/userprofile/submit', 'App\Http\Controllers\ProfileController@subscribetouser')->name("subscribe-form");
Route::post('/userunsubscribe/submit', 'App\Http\Controllers\ProfileController@unsubscribetouser')->name("unsubscribe-form");
Route::post('/requesttouser/submit', 'App\Http\Controllers\ProfileController@requesttouser')->name("requesttouser-form");

Route::post('/incommingrequests/submit', 'App\Http\Controllers\ProfileController@acknowledgerequest')->name("requesttouser-ack");

Route::post('/cancelrequest/submit', 'App\Http\Controllers\ProfileController@rejecterequest')->name("requesttouser-reject");




Route::post('/edittravel/submit', 'App\Http\Controllers\NewPost@onepostmodifysave')->name("modifypub-form");



Route::get('/users', function () {
    return view('users');
});
//Route::get('/posts', 'App\Http\Controllers\NewPost@allpublicposts')->name("publicposts");
Route::get('/travels', 'App\Http\Controllers\NewPost@allpublicposts')->name('posts');
Route::get('/travels', 'App\Http\Controllers\NewPost@index')->name('posts.index');


Route::get('/incommingrequests', 'App\Http\Controllers\ProfileController@incomingrequests')->name("incommingrequests");


Route::get('/myfeed', 'App\Http\Controllers\NewPost@myposts')->name("myposts");
//Route::get('/myprofile', 'App\Http\Controllers\ProfileController@showMeMyProfile')->name("myprofilepublic");

Route::get('/travels/{id}', 'App\Http\Controllers\NewPost@onepostshow')->name("onepost");


Route::get('user/{id}', 'App\Http\Controllers\ProfileController@showUserProfile')->name("profilepublic");
Route::get('/myprofile', 'App\Http\Controllers\ProfileController@myProfile')->name("myprofile");
Route::post('/editprofile', 'App\Http\Controllers\ProfileController@modifyprofile')->name("edit-profile");


Route::get('/edittravel/{id}', 'App\Http\Controllers\NewPost@onepostmodifyshow')->name("postmodify");


Route::get('/traveldelete/{id}', 'App\Http\Controllers\NewPost@onepostdelete')->name("postdelete");
