<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Forum;
use App\Models\Topic;

class Topics extends Component
{
    use WithPagination;

    public $forum;
    public $title;
    public $description;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function mount(Forum $forum)
    {
        $this->forum = $forum;
    }

    public function createTopic()
    {
        $this->validate();

        Topic::create([
            'title' => $this->title,
            'description' => $this->description,
            'forum_id' => $this->forum->id,
            'user_id' => auth()->id(),
        ]);

        $this->reset(['title', 'description']);
        session()->flash('success', 'Topic created successfully!');
    }

    public function render()
    {
        $topics = $this->forum->topics()->with('user')->latest()->paginate(10);
        return view('livewire.topics', compact('topics'));
    }
}
