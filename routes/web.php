<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\EventController;
use App\Http\Controllers\SuperAdmin\CircularController;
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
            Route::get('/website/events', [EventController::class, 'sa_event_index'])->name('sa_event_index');
            Route::get('/website/events/add-events', [EventController::class, 'sp_event_create'])->name('sp.events.create');
            Route::post('/website/events/c/add-events', [EventController::class, 'sp_event_store'])->name('sp.event.post');
            Route::delete('/website/events/d/{event}', [EventController::class, 'sp_event_destroy'])->name('sp.events.destroy');
            Route::get('/website/events/edit-events/', [EventController::class, 'sp_event_edit'])->name('sp.events.edit');
            Route::put('/website/events/u/{event}', [EventController::class, 'sp_event_update'])->name('sp.events.update');

            // Circular

            // routes/web.php
            Route::get('/website/circulars', [CircularController::class, 'sa_circular_index'])->name('sa_circular_index');
            Route::get('/website/circulars/add-circulars', action: [CircularController::class, 'sa_circular_create'])->name('sp.circular.create');
        });
    });
});


// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/email/verify', function () {
    return view('auth.verify-email'); // Create this view for email verification notice
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    $request->user()->markEmailAsVerified();

    return redirect()->route('index'); // Redirect to dashboard after verification
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email route
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth'])->name('verification.send');
