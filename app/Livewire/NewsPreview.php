<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;

class NewsPreview extends Component
{
    public function render()
    {
        $news = News::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(3);

        return view('livewire.news-preview', [
            'news' => $news
        ]);
    }
}
