<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Event;
use App\Models\Blotter;
use Livewire\Component;
use App\Models\Resident;
use App\Models\Announcement;
use App\Models\BarangayOfficial;
use App\Models\CertificateRequest;

class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin-dashboard', [
            'totalResidents' => Resident::count(),
            'totalOfficials' => BarangayOfficial::count(),
            'pendingRequests' => CertificateRequest::where('status', 'Pending')->count(),
            'upcomingEvents' => Event::where('status', 'upcoming')->count(),
            'recentAnnouncements' => Announcement::latest()->take(5)->get(),
            'activeUsers' => User::count(), // Assuming 'status' column exists
            'totalBlotters' => Blotter::count(),
            'pendingBlotters' => Blotter::where('status', 'Pending')->count(),
            'resolvedBlotters' => Blotter::where('status', 'Resolved')->count(),
        ]);
    }
}