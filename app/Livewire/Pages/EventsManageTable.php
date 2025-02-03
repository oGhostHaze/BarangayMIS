<?php

namespace App\Livewire\Pages;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventsManageTable extends Component
{
    use WithPagination;

    public $event_id, $title, $description, $start_date, $end_date, $start_time, $end_time, $location, $status;
    public $isOpen = false; // Controls modal visibility

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'start_time' => 'nullable',
        'end_time' => 'nullable|after_or_equal:start_time',
        'location' => 'nullable|string|max:255',
        'status' => 'required|in:upcoming,ongoing,completed,canceled',
    ];

    public function render()
    {
        $events = Event::orderBy('start_date', 'desc')->paginate(10);
        return view('livewire.pages.events-manage-table', compact('events'));
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $this->event_id = $event->id;
        $this->title = $event->title;
        $this->description = $event->description;
        $this->start_date = $event->start_date;
        $this->end_date = $event->end_date;
        $this->start_time = $event->start_time;
        $this->end_time = $event->end_time;
        $this->location = $event->location;
        $this->status = $event->status;

        $this->openModal();
    }

    public function save()
    {
        $this->validate();

        Event::updateOrCreate(['id' => $this->event_id], [
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'location' => $this->location,
            'status' => $this->status,
        ]);

        session()->flash('message', $this->event_id ? 'Event updated successfully!' : 'Event created successfully!');

        $this->closeModal();
    }

    public function delete($id)
    {
        Event::findOrFail($id)->delete();
        session()->flash('message', 'Event deleted successfully!');
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->event_id = null;
        $this->title = '';
        $this->description = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->location = '';
        $this->status = 'upcoming';
    }
}
