<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Forum;

class Forums extends Component
{
    use WithPagination;

    public function render()
    {
        $forums = Forum::with('user')->latest()->paginate(10);
        return view('livewire.forums', compact('forums'));
    }
}
