<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\EventController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use Illuminate\Foundation\Auth\EmailVerificationNotification;
use Illuminate\Http\Request;
/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Dashboard Route


Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['check.role:1'])->group(function () {
        Route::prefix('cms/portal/s')->group(function () {
            Route::get('/admin', [SuperAdminController::class, 'admin'])->name('admin_dashboard');
            Route::get('/website/event', [EventController::class, 'sa_event_index'])->name('sa_event_index');
            Route::get('/website/event/add-events', [EventController::class, 'sp_event_create'])->name('sp.events.create');
            Route::post('/website/event/c/add-events', [EventController::class, 'sp_event_store'])->name('sp.event.post');
            Route::delete('/website/event/d/id?={event}', [EventController::class, 'sp_event_destroy'])->name('sp.events.destroy');
        });
    });
});


// Home Route
Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email'); // Create this view for email verification notice
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    $request->user()->markEmailAsVerified();

    return redirect()->route('dashboard'); // Redirect to dashboard after verification
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email route
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth'])->name('verification.send');
