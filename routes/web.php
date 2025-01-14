<?php

use App\Http\Controllers\TopicController;
use App\Livewire\Forums;
use App\Livewire\MosqueLandingPage;
use App\Livewire\Topics;
use App\Livewire\ViewEvent;
use App\Livewire\ViewNews;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Livewire\OrganizationChart;
use App\Livewire\Donation;

Route::get('/', MosqueLandingPage::class);
Route::get('/news/{slug}', ViewNews::class)->name('news.view');
Route::get('/events/{eventId}', ViewEvent::class)->name('events.view');

Route::get('/forums', Forums::class)->name('forums.index');
Route::get('/forums/{forum}', Topics::class)->name('forums.show');
Route::get('/topics/{topic}', [TopicController::class, 'show'])->name('topics.show');

Route::get('/donation', Donation::class)->name('donation.index');
Route::post('/donation/callback', [DonationController::class, 'handleCallback'])->name('donation.callback');

Route::get('/organization-chart', action: OrganizationChart::class)->name('organization-chart.index');
