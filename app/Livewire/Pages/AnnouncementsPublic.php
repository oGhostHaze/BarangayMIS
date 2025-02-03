<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Announcement;

class AnnouncementsPublic extends Component
{
    public function render()
    {
        return view('livewire.pages.announcements-public', [
            'announcements' => Announcement::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->get(),
        ]);
    }
}