<?php

use App\Livewire\Forums;
use App\Livewire\MosqueLandingPage;
use App\Livewire\Topics;
use App\Livewire\ViewEvent;
use App\Livewire\ViewNews;
use Illuminate\Support\Facades\Route;

Route::get('/', MosqueLandingPage::class);
Route::get('/news/{slug}', ViewNews::class)->name('news.view');
Route::get('/events/{eventId}', ViewEvent::class)->name('events.view');

Route::get('/forums', Forums::class)->name('forums.index');
Route::get('/forums/{forum}', Topics::class)->name('forums.show');
