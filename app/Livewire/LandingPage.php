<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use App\Models\Event;

class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.landing-page', [
            'announcements' => Announcement::where('status', 'published')
                ->latest()
                ->take(3)
                ->get(),
            'events' => Event::where('status', 'upcoming')
                ->orderBy('start_date')
                ->take(3)
                ->get(),
        ])->layout('back.layouts.pages-layout');
    }
}
