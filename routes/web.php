<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

// ========================================
// PUBLIC WEBSITE ROUTES
// ========================================

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/skills', function () {
    return view('skills');
})->name('skills');

Route::get('/projects', function () {
    $projects = Project::where('is_published', true)
        ->latest()
        ->get();

    return view('projects', compact('projects'));
})->name('projects');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');


// ========================================
// ADMIN AUTHENTICATION ROUTES
// ========================================

Route::prefix('admin')
    ->name('admin.')
    ->middleware('guest:admin')
    ->group(function () {

        Route::get('/login', [AdminController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AdminController::class, 'login'])
            ->name('login.submit');
    });


// ========================================
// PROTECTED ADMIN ROUTES
// ========================================

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // Logout
        Route::post('/logout', [AdminController::class, 'logout'])
            ->name('logout');

        // Message Management
        Route::get('/messages', [AdminController::class, 'messages'])
            ->name('messages');

        Route::get('/messages/{message}', [AdminController::class, 'showMessage'])
            ->name('messages.show');

        Route::patch('/messages/{message}/read', [AdminController::class, 'markMessageRead'])
            ->name('messages.read');

        Route::delete('/messages/{message}', [AdminController::class, 'destroyMessage'])
            ->name('messages.destroy');

        // Project Management (All CRUD routes protected)
        Route::resource('projects', ProjectController::class)
            ->except(['show']);
    });

