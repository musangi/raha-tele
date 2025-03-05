<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::any('/about-raha-tele', [PageController::class, 'aboutRahaTele'])->name('about.rahaTele');
Route::any('/raha-tele-tips', [PageController::class, 'tips'])->name('about.tips');
Route::any('/faq', [PageController::class, 'faq'])->name('about.faq');
Route::any('/success-stories', [PageController::class, 'successStories'])->name('about.successStories');
Route::any('/about-us', [PageController::class, 'aboutUs'])->name('company.aboutUs');
Route::any('/safety-tips', [PageController::class, 'safetyTips'])->name('company.safetyTips');
Route::any('/careers', [PageController::class, 'careers'])->name('company.careers');
Route::any('/terms', [PageController::class, 'terms'])->name('company.terms');
Route::any('/privacy-policy', [PageController::class, 'privacy'])->name('policies.privacy');
Route::any('/consumer-health-data-privacy', [PageController::class, 'healthDataPrivacy'])->name('policies.healthDataPrivacy');
Route::any('/compliance', [PageController::class, 'compliance'])->name('policies.compliance');
Route::any('/accessibility', [PageController::class, 'accessibility'])->name('policies.accessibility');
Route::any('/subscribe', [SubscriptionController::class, 'index'])->name('subscribe.index');
Route::any('/subscribe/store', [SubscriptionController::class, 'store'])->name('subscribe.store');

Auth::routes();

/**
 * ==========================================================================================
 * PORTALS ROUTES
 * ==========================================================================================
 */
Route::group(['prefix' => 'portal', 'middleware' => ['auth']], function () {
    // Dashboard Route (Ensure it's within the group with correct prefix and middleware)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/show/{id}', [ProfileController::class, 'show'])->name('profile.show');
    // Match Routes
    Route::get('/matches', [MatchController::class, 'index'])->name('matches');
    // Message Routes
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/messages/{user}', [MessageController::class, 'index'])->name('messages.show');
    Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store');
    

    // Explore Routes
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    Route::post('/match/like/{id}', [MatchController::class, 'like'])->name('match.like');
    Route::post('/match/dislike/{id}', [MatchController::class, 'dislike'])->name('match.dislike');
    
});