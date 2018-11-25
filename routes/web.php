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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/init','AdminIndex@init');
Route::get('admin/index','AdminIndex@index');


//学生模块
 Route::group(['prefix'=>'student','middleware'=>'web'],function(){
     Route::get('index',['uses'=>'StudentController@index']);
     Route::post('search',['uses'=>'StudentController@search']);
     Route::get('create',['uses'=>'StudentController@create']);
     Route::post('save',['uses'=>'StudentController@save']);
     Route::any('edit/{id}',['uses'=>'StudentController@edit']);
     Route::post('status',['uses'=>'StudentController@status']);
     Route::any('show/{id}',['uses'=>'StudentController@show']);
     Route::post('del',['uses'=>'StudentController@del']);
 });

Auth::routes();

Route::get('/home', 'HomeController@index');
