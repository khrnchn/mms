<?php

use App\Livewire\MosqueLandingPage;
use App\Livewire\ViewEvent;
use App\Livewire\ViewNews;
use Illuminate\Support\Facades\Route;

Route::get('/', MosqueLandingPage::class);
Route::get('/news/{slug}', ViewNews::class)->name('news.view');
Route::get('/events/{eventId}', ViewEvent::class)->name('events.view');
