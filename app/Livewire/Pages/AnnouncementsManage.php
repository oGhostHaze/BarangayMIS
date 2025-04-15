<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithPagination;

class AnnouncementsManage extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.pages.announcements-manage', [
            'announcements' => Announcement::paginate(10),
        ]);
    }

    public function delete($id)
    {
        $announcement = Announcement::find($id);
        if ($announcement) {
            $announcement->delete();
            session()->flash('success', 'Announcement deleted successfully.');
        } else {
            session()->flash('error', 'Announcement not found.');
        }
    }
}
