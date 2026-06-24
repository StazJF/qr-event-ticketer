<?php

use App\Http\Controllers\Api\CheckInController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api')->group(function (): void {
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::post('/register', RegistrationController::class)->middleware('throttle:6,1');
    Route::post('/checkin', CheckInController::class)->middleware('admin.api');
    Route::get('/ticket/{code}', TicketController::class);
});
