<?php

namespace App\Livewire;

use App\Models\LinkClick;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LinkHistory extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $links = LinkClick::query()
            ->where('user_id', Auth::id())
            ->when($this->search, fn ($q) =>
                $q->where(function ($q) {
                    $q->where('url', 'like', "%{$this->search}%")
                      ->orWhere('page_title', 'like', "%{$this->search}%");
                })
            )
            ->latest()
            ->paginate(10);

        return view('livewire.link-history', compact('links'));
    }
}


// app/Livewire/LinkHistory.php
// namespace App\Livewire;

// use App\Models\LinkClick;
// use Illuminate\Support\Facades\Auth;
// use Livewire\Component;

// class LinkHistory extends Component
// {

//     public $search = '';

//     public function render()
//     {
//         $links = LinkClick::query()
//             ->where('user_id', Auth::id())
//             ->when($this->search, fn ($q) =>
//                 $q->where('url', 'like', "%{$this->search}%")
//                   ->orWhere('page_title', 'like', "%{$this->search}%"))
//             ->latest()
//             ->get();

//         return view('livewire.link-history', compact('links'));
//     }
//     public $search = '';

//     public function render()
//     {
//         $links = LinkClick::query()
//             ->where('user_id', Auth::id())
//             ->when($this->search, fn ($query) =>
//                 $query->where('url', 'like', "%{$this->search}%")
//                       ->orWhere('page_title', 'like', "%{$this->search}%")
//             )
//             ->latest()
//             ->paginate(20); // Add pagination for performance

//         return view('livewire.link-history', [
//             'links' => $links,
//         ]);
//     }
// }
