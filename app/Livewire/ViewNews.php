<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;

class ViewNews extends Component
{
    public $news;

    public function mount($slug)
    {
        $this->news = News::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.view-news');
    }
}
