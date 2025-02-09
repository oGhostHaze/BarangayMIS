<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Announcement;

class AnnouncementsShow extends Component
{
    public $announcement;

    public function mount($id)
    {
        $this->announcement = Announcement::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.pages.announcements-show')->layout('back.layouts.pages-layout');
    }
}
