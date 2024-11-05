<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/about-raha-tele', [PageController::class, 'aboutRahaTele'])->name('about.rahaTele');
Route::get('/raha-tele-tips', [PageController::class, 'tips'])->name('about.tips');
Route::get('/faq', [PageController::class, 'faq'])->name('about.faq');
Route::get('/success-stories', [PageController::class, 'successStories'])->name('about.successStories');

Route::get('/about-us', [PageController::class, 'aboutUs'])->name('company.aboutUs');
Route::get('/safety-tips', [PageController::class, 'safetyTips'])->name('company.safetyTips');
Route::get('/careers', [PageController::class, 'careers'])->name('company.careers');
Route::get('/terms', [PageController::class, 'terms'])->name('company.terms');

Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('policies.privacy');
Route::get('/consumer-health-data-privacy', [PageController::class, 'healthDataPrivacy'])->name('policies.healthDataPrivacy');
Route::get('/compliance', [PageController::class, 'compliance'])->name('policies.compliance');
Route::get('/accessibility', [PageController::class, 'accessibility'])->name('policies.accessibility');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');