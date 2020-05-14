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

use App\Http\Controllers\Common\Dashboard;
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
})->name('registerUser')->middleware(['role:admin']);




Route::resource('messages','Common\MessageController');
Route::resource('repairs','User\RepairController');
Route::resource('help-desks','User\HelpDeskController');
Route::resource('user','User\UserController');



Route::get('/change-password',function(){
    return view('common.change_password');
})->name('chpass');

Route::Post('/change-password','Common\Dashboard@changePass')->name('changePass');



Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Common')->group(function () {
    Route::get('/report','ReportController@index')->name('AdminReport');
    Route::post('/getReport','ReportController@reportFromProject')->name('getReport');

});
