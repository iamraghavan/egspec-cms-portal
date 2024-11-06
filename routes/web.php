<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\EventController;
use App\Http\Controllers\SuperAdmin\CircularController;
use App\Http\Controllers\SuperAdmin\NewsPaperCutoutController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use Illuminate\Foundation\Auth\EmailVerificationNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\SuperAdmin\CategoryController;

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
            Route::get('/admin/profile', [SuperAdminController::class, 'profile'])->name('admin_profile');
            Route::put('/admin/profile/update', [SuperAdminController::class, 'updateProfile'])->name('admin.updateProfile');

            // Events

            Route::get('/website/events', [EventController::class, 'sa_event_index'])->name('sa_event_index');
            Route::get('/website/events/add-events', [EventController::class, 'sp_event_create'])->name('sp.events.create');
            Route::post('/website/events/c/add-events', [EventController::class, 'sp_event_store'])->name('sp.event.post');
            Route::delete('/website/events/d/{event}', [EventController::class, 'sp_event_destroy'])->name('sp.events.destroy');
            Route::get('/website/events/edit-events/', [EventController::class, 'sp_event_edit'])->name('sp.events.edit');
            Route::put('/website/events/u/{event}', [EventController::class, 'sp_event_update'])->name('sp.events.update');

            // Circular

            Route::get('/website/circulars', [CircularController::class, 'sa_circular_index'])->name('sa_circular_index');
            Route::get('/website/circulars/add-circulars', action: [CircularController::class, 'sa_circular_create'])->name('sp.circular.create');
            Route::post('/website/circulars/c/add-circulars', [CircularController::class, 'sp_circular_store'])->name('sp.circular.post');
            Route::delete('/website/circulars/d/{circular}', [CircularController::class, 'sp_circular_destroy'])->name('sp.circular.destroy');
            Route::get('/website/circulars/edit-circulars/', [CircularController::class, 'sp_circular_edit'])->name('sp.circular.edit');
            Route::put('/website/circulars/u/{circular}', [CircularController::class, 'sp_circular_update'])->name('sp.circular.update');

            // Newspaper Cuts

            Route::get('/website/newspaper-cuts', [NewsPaperCutoutController::class, 'sa_newspcc_index'])->name('sa_newspcc_index');
            Route::get('/website/newspaper-cuts/view', [NewsPaperCutoutController::class, 'sa_newspcc_view'])->name('sp.newspcc.view');
            Route::get('/website/newspaper-cuts/add-newspaper-cuts', [NewsPaperCutoutController::class, 'sa_newspcc_create'])->name('sp.newspcc.create');
            Route::post('/website/newspaper-cuts/c/add-newspaper-cuts', [NewsPaperCutoutController::class, 'sp_newspcc_store'])->name('sp.newspcc.post');
            Route::delete('/website/newspaper-cuts/d/{newspcc}', [NewsPaperCutoutController::class, 'sp_newspcc_destroy'])->name('sp.newspcc.destroy');


            // Categories


            Route::get('/website/categories/', [CategoryController::class, 'sa_categories_index'])->name('sa_categories_index');
            Route::post('/website/categories/c/', [CategoryController::class, 'sa_categories_post'])->name('sa_categories_post');
            Route::get('/website/categories/add-categories', [CategoryController::class, 'sa_categories_create'])->name('sa_categories_create');
            Route::get('/website/categories/{id}/edit', [CategoryController::class, 'sa_categories_edit'])->name('sa_categories_edit');
            Route::put('/website/categories/u/{id}', [CategoryController::class, 'sa_categories_update'])->name('sa_categories_update');
            Route::delete('/website/categories/d/{id}', [CategoryController::class, 'sa_categories_destroy'])->name('sa_categories_destroy');
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
