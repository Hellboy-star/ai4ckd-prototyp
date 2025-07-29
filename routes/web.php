<?php

use App\Livewire\Patients\Index;
use App\Livewire\Patients\Show;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Route::view('/', 'welcome');

// Route::middleware(['auth'])->group(function () {
    Route::get('/patients', Index::class)->name('patients.index');
    Route::get('/patients/{id}', Show::class)->name('patients.show');
// });
Route::view('dashboard', 'dashboard')
    // ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

require __DIR__.'/auth.php';
