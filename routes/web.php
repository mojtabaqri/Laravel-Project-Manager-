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

use App\Http\Controllers\User\UserController;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
Route::get('/', function () {
     return redirect('login');
});


Route::get('/dashboard','Common\Dashboard@show')->name('dashboard');

Route::resource('projects','User\ProjectController');

Route::get('/registeruser',function(){
    return view('admin.register');
})->name('registerUser');


Route::get('/report',function(){
    return view('admin.report');
})->name('AdminReport');


Route::resource('messages','Common\MessageController');
Route::resource('repairs','User\RepairController');
Route::resource('help-desks','User\HelpDeskController');
Route::resource('user','User\UserController');



Route::get('/change-password',function(){
    return view('common.change_password');
})->name('chpass');

Route::Post('/change-password','User\UserController@changePass');





Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
