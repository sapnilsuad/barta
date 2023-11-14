<?php

use Illuminate\Support\Facades\Route;  
 
   
Route::get('/', 'App\Http\Controllers\LoginRegisterController@index');  
Route::post('/', 'App\Http\Controllers\LoginRegisterController@login');  
Route::get('/register', 'App\Http\Controllers\LoginRegisterController@create'); 
Route::post('/register', 'App\Http\Controllers\LoginRegisterController@store');  
Route::post('/logout', 'App\Http\Controllers\LoginRegisterController@logout');  
// Profile     
Route::get('/profile', 'App\Http\Controllers\ProfileController@profile');    
Route::get('/edit-profile', 'App\Http\Controllers\ProfileController@EditView');   
Route::put('/edit-profile', 'App\Http\Controllers\ProfileController@edit');      

    
