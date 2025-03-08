<?php

namespace App\Livewire\Resident;

use App\Models\Announcement;
use App\Models\Blotter;
use App\Models\CertificateRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $pendingCertificates = 0;
    public $approvedCertificates = 0;
    public $releasedCertificates = 0;
    public $announcements = [];
    public $upcomingEvents = [];

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function render()
    {
        return view('livewire.resident.dashboard')->layout('back.layouts.pages-layout');
    }

    private function loadDashboardData()
    {
        // Get resident ID from the authenticated user
        $resident = Auth::user()->resident;

        if ($resident) {
            // Count certificate requests by status
            $this->pendingCertificates = CertificateRequest::where('resident_id', $resident->id)
                ->where('status', 'pending')
                ->count();

            $this->approvedCertificates = CertificateRequest::where('resident_id', $resident->id)
                ->where('status', 'approved')
                ->count();

            $this->releasedCertificates = CertificateRequest::where('resident_id', $resident->id)
                ->where('status', 'released')
                ->count();
        }

        // Get latest announcements
        $this->announcements = Announcement::where('status', 'published')
            ->whereDate('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        // Get upcoming events
        $this->upcomingEvents = Event::where('status', 'active')
            ->whereDate('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->limit(3)
            ->get();
    }

    public function refreshDashboard()
    {
        $this->loadDashboardData();
    }
}