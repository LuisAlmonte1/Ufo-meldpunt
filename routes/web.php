<?php

use App\Http\Controllers\UfoReportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Dashboard route (for after registration/login redirects)
Route::get('/dashboard', function () {
    return redirect('/')->with('success', 'Welkom bij UFO Meldpunt Nederland!');
})->middleware('auth')->name('dashboard');

// UFO Report routes
Route::get('/meld', [UfoReportController::class, 'create'])->middleware('auth')->name('reports.create');
Route::post('/meld', [UfoReportController::class, 'store'])->name('reports.store');

// Thank you page
Route::get('/bedankt/{id}', function ($id) {
    $report = \App\Models\UfoReport::findOrFail($id);
    return view('reports.thanks', compact('report'));
})->name('reports.thanks');

// About page
Route::get('/over-ons', function () {
    return view('about');
})->name('about');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/mijn-meldingen', [UfoReportController::class, 'myReports'])->name('reports.my-reports');
    
    // Profile routes (required by Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes (Laravel Breeze)
require __DIR__.'/auth.php';