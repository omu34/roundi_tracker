<?php

use Illuminate\Support\Facades\Route;
// routes/web.php
use App\Http\Controllers\LinkRedirectController;
use App\Livewire\LinkHistory;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');



Route::middleware(['auth'])->group(function () {
    Route::get('/links', LinkHistory::class)->name('links.history');
});

Route::get('/redirect', [LinkRedirectController::class, 'redirect'])->name('track.redirect');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
