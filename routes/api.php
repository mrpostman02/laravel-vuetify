<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'contact'], function(){
    Route::get('getContacts', [App\Http\Controllers\ContactController::class, 'getContacts'])->name('getContacts');
    Route::post('saveContact', [App\Http\Controllers\ContactController::class, 'saveContact'])->name('saveContact');
    Route::delete('deleteContact/{id}', [App\Http\Controllers\ContactController::class, 'deleteContact'])->name('deleteContact');
    Route::post('updateContact/{id}', [App\Http\Controllers\ContactController::class, 'updateContact'])->name('updateContact');
});