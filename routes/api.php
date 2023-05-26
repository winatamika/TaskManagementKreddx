<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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


Route::get('allTasks', 'TasksController@index');
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
Route::get('/tasksfilter', [TasksController::class, 'filter'])->name('tasks.filter');
Route::get('/tasks/{id}', [TasksController::class, 'show'])->name('tasks.show');
Route::post('/tasks/{id}', [TasksController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [TasksController::class, 'destroy'])->name('tasks.destroy');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
