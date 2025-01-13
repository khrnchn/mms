<?php

namespace App\Http\Controllers;

use App\Livewire\Replies;
use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        return app(Replies::class, ['topic' => $topic])();
    }
}
