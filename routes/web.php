<?php
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolUploadController;
use App\Http\Controllers\RepresentativeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can rgister web routes for your application. These
| routes are loaded by the RouteServieceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/upload-files', [FileUploadController::class, 'uploadFiles'])->name('upload.files');

Route::post('/upload-school', [SchoolUploadController::class, 'store'])->name('upload.school');

Route::post('/upload-representative', [RepresentativeController::class, 'uploadRepresentative'])->name('upload.representative');

Route::get('/analytics', [App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics');
//Route::get('/table', [App\Http\Controllers\TableController::class, 'index'])->name('table');

Route::get('/guest', [App\Http\Controllers\GuestController::class, 'index'])->name('guest');

Route::get('/tables', [App\Http\Controllers\TableController::class, 'retrieveTableInformation'])->name('page.index');

Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('dashboard');
Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('dashboard');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});




