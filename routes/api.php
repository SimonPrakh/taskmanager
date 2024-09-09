<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TeamController;

// Маршруты для аутентификации
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Группа маршрутов, требующих аутентификацию
Route::middleware('auth:sanctum')->group(function () {

    // Маршруты для задач (Tasks)
    Route::apiResource('tasks', TaskController::class);

    // Маршруты для комментариев (Comments)
    Route::post('/tasks/{taskId}/comments', [CommentController::class, 'store']);
    Route::get('/tasks/{taskId}/comments', [CommentController::class, 'index']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

    // Маршруты для команд (Teams)
    Route::apiResource('teams', TeamController::class)->except(['update', 'show', 'destroy']);
    Route::post('/teams/{teamId}/users', [TeamController::class, 'addUser']);
    Route::delete('/teams/{teamId}/users/{userId}', [TeamController::class, 'removeUser']);
});
