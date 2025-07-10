<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController; // TASK CONTROLLER
Use App\Http\Controllers\PersonController; // PERSON CONTROLLER

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ROUTE TASKS 
Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{task}', [TaskController::class, 'update']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
Route::post('/tasks/{task}/assign', [TaskController::class, 'assignTask']);
Route::post('/tasks/{task}/unassign', [TaskController::class, 'unassignTask']);
Route::get('/persons', [PersonController::class, 'index']);
Route::post('/persons', [PersonController::class, 'store']);
Route::delete('/persons/{person}', [PersonController::class, 'destroy']);
Route::get('/tasks/{task}', [TaskController::class, 'show']);
Route::get('persons/{person}', [PersonController::class, 'show']);
Route::delete('persons/{person}', [PersonController::class, 'destroy']);
Route::put('persons/{person}', [PersonController::class, 'update']);
Route::post('/tasks/{task}/unassign', [TaskController::class, 'unassignTask']);


