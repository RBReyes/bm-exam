<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;


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

// Route::get('/admin-home', 'GuestController@landing')->name('landing');

Route::get('/admin',[GuestController::class, 'landing'])->name('landing');;
Route::post('/login',[GuestController::class, 'authenticate'])->name('login');
Route::get('/logout',[GuestController::class, 'logout'])->name('logout');


Route::name('admin.')->group(function () {
    Route::get('/app-setting',[AdminController::class, 'appSetting'])->name('app-setting');
    Route::post('admin/save-app-setting',[AdminController::class, 'saveSetting'])->name('save-setting');
    Route::get('/admin/app-setting-data',[AdminController::class, 'getAppSetting'])->name('get-setting');
    Route::get('/categories',[AdminController::class, 'category'])->name('category');
    Route::post('admin/save-category',[AdminController::class, 'saveCategory'])->name('save-category');
    Route::get('admin/get-category',[AdminController::class, 'getCategory']);
    
    Route::post('admin/save-city',[AdminController::class, 'saveCity']);
    Route::get('/admin-city',[AdminController::class, 'city'])->name('city');
    Route::get('admin/get-city',[AdminController::class, 'getCity']);

    Route::post('admin/save-guideline',[AdminController::class, 'saveGuide']);
    Route::get('/admin/trip-guideline',[AdminController::class, 'guideline'])->name('guideline');
    Route::get('admin/get-guideline',[AdminController::class, 'getGuideline']);

    
    Route::post('admin/save-to-do',[AdminController::class, 'saveToDo']);
    Route::get('/admin/trip-to-do',[AdminController::class, 'toDo'])->name('todo');
    Route::get('admin/get-to-do',[AdminController::class, 'getToDo']);
    Route::get('admin/get-data',[AdminController::class, 'getData']);


});


Route::name('guest.')->group(function () {
    Route::get('/',[GuestController::class, 'guestHome'])->name('guest-home');
    Route::get('/plan/{id}',[GuestController::class, 'viewPlan']);
    Route::get('/category/{id}',[GuestController::class, 'viewToDo']);
    Route::get('/to-do/{id}',[GuestController::class, 'viewSubToDo']);
    Route::get('/city/{id}',[GuestController::class, 'viewCity']);
});


