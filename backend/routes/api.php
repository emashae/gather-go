<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Auth

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

//Events
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{event}', [EventController::class, 'update']);
    Route::delete('/events/{event}', [EventController::class, 'destroy']);
});

//Feedback
Route::middleware('auth:sanctum')->group(function () {
    Route::post('events/{eventId}/feedback', [FeedbackController::class, 'store']);
    Route::get('events/{eventId}/feedback', [FeedbackController::class, 'index']);
    Route::get('feedback/{feedbackId}', [FeedbackController::class, 'show']);
    Route::put('feedback/{feedbackId}', [FeedbackController::class, 'update']);
    Route::delete('feedback/{feedbackId}', [FeedbackController::class, 'destroy']);
});

