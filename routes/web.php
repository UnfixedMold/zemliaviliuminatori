<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
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

// Auth routes

Auth::routes();

// Admin routes

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/members/{member}/edit', 'MembersController@edit')->name('editMember');
Route::put('/members/{member}/update', 'MembersController@update')->name('updateMember');
Route::get('/members', 'MembersController@index')->name('members');
Route::post('/invitations', 'InvitationsController@store')->name('invitations.store');
Route::get('/invitations', 'InvitationsController@index')->name('invitations');

Route::redirect('/', '/login');

