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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get("/tasks", [
    "uses" => "TaskController@index",
    "as"   => "tasks.index"
]);

Route::post("tasks/create", [
   "uses" => "TaskController@store",
   "as"   => "tasks.store"
]);

Route::patch("tasks/{task}/complete", [
    "uses" => "CompleteTaskController@store",
    "as"   => "tasks.complete.store"
]);

Route::patch("tasks/{task}/incomplete", [
    "uses" => "CompleteTaskController@destroy",
    "as"   => "tasks.complete.destroy"
]);
