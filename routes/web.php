<?php

use App\Http\Controllers\Admin\CheckInController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredAdminController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicEventController::class, 'index'])->name('events.public.index');
Route::get('/events/{event}', [PublicEventController::class, 'show'])->name('events.public.show');
Route::post('/events/{event}/register', [PublicEventController::class, 'register'])
    ->middleware('throttle:6,1')
    ->name('events.register');
Route::get('/tickets/{code}', [TicketController::class, 'show'])->name('tickets.show');
Route::get('/tickets/{code}/download', [TicketController::class, 'download'])->name('tickets.download');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:5,1');
    Route::get('/admin/register', [RegisteredAdminController::class, 'create'])->name('admin.register.create');
    Route::post('/admin/register', [RegisteredAdminController::class, 'store'])
        ->middleware('throttle:3,1')
        ->name('admin.register.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('events', AdminEventController::class);
    Route::get('/checkin', [CheckInController::class, 'create'])->name('checkin.create');
    Route::post('/checkin', [CheckInController::class, 'store'])->name('checkin.store');
});
