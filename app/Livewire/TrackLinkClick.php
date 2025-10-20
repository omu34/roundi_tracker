<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LinkClick;

class TrackLinkClick extends Component
{
    public string $url;

    public function recordClick()
    {
        LinkClick::create(['url' => $this->url]);
        return redirect()->to($this->url);
    }

    public function render()
    {
        return view('livewire.track-link-click');
    }
}
