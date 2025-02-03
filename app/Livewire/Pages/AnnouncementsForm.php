<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithFileUploads;

class AnnouncementsForm extends Component
{
    use WithFileUploads;

    public $announcement_id, $title, $excerpt, $content, $category, $image, $status = 'draft', $published_at;

    public function mount($id = null)
    {
        if ($id) {
            $post = Announcement::findOrFail($id);
            $this->announcement_id = $post->id;
            $this->title = $post->title;
            $this->excerpt = $post->excerpt;
            $this->content = $post->content;
            $this->category = $post->category;
            $this->status = $post->status;
            $this->published_at = $post->published_at;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required',
            'excerpt' => 'nullable|max:255',
            'content' => 'required',
            'category' => 'nullable',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);
        $validated['user_id'] = auth()->id();

        if ($this->image) {
            $this->validate([
                'image' => 'nullable|image|max:2048'
            ]);
            $validated['image'] = $this->image->store('announcements', 'public');
        }

        if($validated['status'] == 'published' && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        Announcement::updateOrCreate(['id' => $this->announcement_id], $validated);

        session()->flash('message', 'Announcement saved successfully!');
        return redirect()->route('auth.announcements.manage');
    }

    public function render()
    {
        return view('livewire.pages.announcements-form');
    }
}