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
        'content' => 'required|string|min:3',
    ];

    public function mount(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function createReply()
    {
        // Validate the input
        $this->validate();

        // Create the reply
        Reply::create([
            'content' => $this->content,
            'topic_id' => $this->topic->id,
            'user_id' => auth()->id(),
        ]);

        // Clear the input field
        $this->reset('content');

        // Show a success message
        session()->flash('success', 'Reply posted successfully!');
    }

    public function render()
    {
        $replies = $this->topic->replies()->with('user')->latest()->paginate(10);
        return view('livewire.replies', [
            'topic' => $this->topic,
            'replies' => $replies,
        ]);
    }
}
