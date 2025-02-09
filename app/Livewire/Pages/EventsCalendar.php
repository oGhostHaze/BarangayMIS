<?php

namespace App\Livewire\Pages;

use App\Models\Event;
use Livewire\Component;

class EventsCalendar extends Component
{
    public $events = [];

    public function mount()
    {
        $this->fetchEvents();
    }

    public function fetchEvents()
    {
        $this->events = Event::select('id', 'title', 'start_date', 'end_date')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start_date,
                    'end' => $event->end_date ?? $event->start_date,
                ];
            })->toArray();
    }

    public function render()
    {
        return view('livewire.pages.events-calendar')->layout('back.layouts.pages-layout');
    }
}
