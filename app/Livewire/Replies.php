<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Topic;
use App\Models\Reply;

class Replies extends Component
{
    use WithPagination;

    public $topic;
    public $content;

    protected $rules = [
        'content' => 'required|string',
    ];

    public function mount(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function createReply()
    {
        $this->validate();

        Reply::create([
            'content' => $this->content,
            'topic_id' => $this->topic->id,
            'user_id' => auth()->id(),
        ]);

        $this->reset(['content']);
        session()->flash('success', 'Reply posted successfully!');
    }

    public function render()
    {
        $replies = $this->topic->replies()->with('user')->latest()->paginate(10);
        return view('livewire.replies', compact('replies'));
    }
}
