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

/*Route::get('/', function () {
    return view('welcome');
});
*/



Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');
    
    Route::group(['middleware' => 'can:view,folder'], function() {
        Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');
        Route::post('/folders/{folder}/tasks', 'FolderController@update')->name('tasks.index');
        Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', 'TaskController@create');
        Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
        Route::get('/folders/{folder}/tasks/{task}/bbs', 'NoteController@show')->name('bbs.show');
        Route::post('/folders/{folder}/tasks/{task}/bbs', 'NoteController@store');
        Route::delete('/folders/{folder}/tasks/{task}/bbs', 'NoteController@destroy');
        Route::get('/folders/{folder}/tasks/{task}/bbs_edit/{note}','NoteController@edit')->name('bbs.edit');
        Route::put('/folders/{folder}/tasks/{task}/bbs', 'NoteController@update');
        //Route::resource('/folders/{folder}/tasks/{task}/notes', 'Notecontroller', ['only'=>['show','store','update']]);
    });
});

Auth::routes();