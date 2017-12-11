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
    "uses" => "TasksController@index",
    "as"   => "tasks.index"
]);

Route::post("tasks/create", [
   "uses" => "TasksController@store",
   "as"   => "tasks.store"
]);

Route::patch("tasks/{task}/complete", [
    "uses" => "CompleteTasksController@store",
    "as"   => "tasks.complete.store"
]);

Route::patch("tasks/{task}/incomplete", [
    "uses" => "CompleteTasksController@destroy",
    "as"   => "tasks.complete.destroy"
]);

Route::post("projects", [
   "uses" => "ProjectsController@store",
   "as"   => "projects.store"
]);

Route::delete("projects/{project}", [
   "uses" => "ProjectsController@destroy",
   "as"   => "projects.destroy"
]);
