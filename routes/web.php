<?php

use App\Http\Controllers\UfoReportController;
use Illuminate\Support\Facades\Route;

// Homepage - THIS IS CRITICAL
Route::get('/', function () {
    return view('home');
    // Dashboard route (for after registration/login)
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware('auth')->name('dashboard');
});

// UFO Report routes
Route::get('/meld', [UfoReportController::class, 'create'])->name('reports.create');
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
});

// Authentication routes (Laravel Breeze)
require __DIR__.'/auth.php';
