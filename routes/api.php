<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/get-guide/{id}',[GuestController::class, 'getGuide']);

