<?php

use App\Models\Blotter;
use App\Livewire\BlotterEdit;
use App\Livewire\LandingPage;
use App\Livewire\BlotterCreate;
use App\Livewire\BlotterDetail;
use App\Livewire\BlotterManage;
use App\Livewire\AdminDashboard;
use App\Livewire\SystemSettings;
use App\Livewire\BarangayOrgChart;
use App\Livewire\Pages\ResidentShow;
use App\Livewire\Resident\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\CertificateIndigency;
use App\Livewire\CertificateTemplate1;
use App\Livewire\Pages\EventsCalendar;
use App\Livewire\Pages\ResidentsManage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Livewire\Pages\AnnouncementsForm;
use App\Livewire\Pages\AnnouncementsShow;
use App\Livewire\Pages\EventsManageTable;
use App\Livewire\User\UserAccountSettings;
use App\Livewire\Pages\AnnouncementsManage;
use App\Livewire\Pages\AnnouncementsPublic;
use App\Livewire\Pages\BlotterEditResident;
use App\Livewire\Pages\EditBlotterResident;
use App\Livewire\Pages\ResidentsCreateForm;
use App\Livewire\Pages\BlotterCreateResident;
use App\Livewire\Pages\CertificateIssuedPage;
use App\Livewire\Pages\CreateBlotterResident;
use App\Livewire\Pages\BlotterDetailsResident;
use App\Livewire\Pages\CertificateRequestPage;
use App\Livewire\Pages\ResidentsManagePending;
use App\Livewire\Auth\ResidentSelfRegistration;
use App\Livewire\Pages\BarangayOfficialsManage;
use App\Livewire\Pages\BlotterRequestsResident;
use App\Livewire\Pages\CertificateRequestsResident;






Route::get('/', LandingPage::class)->name('landing');
Route::get('/org-chart', BarangayOrgChart::class)->name('org-chart');
Route::get('/announcements/feed', AnnouncementsPublic::class)->name('announcements.feed');
Route::get('/events/calendar', EventsCalendar::class)->name('events.calendar');

Route::middleware(['guest:web'])->group(function () {
    Route::get('/register', ResidentSelfRegistration::class)->name('auth.register');
    Route::view('/login', 'back.pages.auth.login')->name('login');
    Route::view('/auth/login', 'back.pages.auth.login')->name('auth.login');
    Route::view('/forgot-password', 'back.pages.auth.forgot')->name('auth.forgot-password');
    Route::get('/password/reset/{token}', [AuthController::class, 'ResetForm'])->name('auth.reset-form');
});

Route::get('/home', function () {
    return redirect()->route('auth.dashboard');
})->name('home');

Route::name('auth.')->middleware(['auth:web'])->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('events.calendar');
    })->name('home');

    Route::get('/logout', function () {
        Auth::guard('web')->logout();
        return redirect()->route('auth.login');
    })->name('logout');

    Route::get('/account/settings', UserAccountSettings::class)->name('user.account.settings');

    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('barangay_official')) {
            return redirect()->route('auth.admin.dashboard');
        } else {
            return redirect()->route('auth.resident.dashboard');
        }
    })->middleware(['auth'])->name('dashboard');


    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            if (auth()->user()->hasRole('barangay_official')) {
                return redirect()->route('auth.admin.dash');
            } else {
                return redirect()->route('auth.resident.dashboard');
            }
        })->name('dashboard');
        Route::get('/', AdminDashboard::class)->name('dash');
        Route::prefix('/manage-users')->name('users.')->group(function () {
            Route::get('/list', [UsersController::class, 'index'])->name('list');
            Route::get('/create', [UsersController::class, 'create'])->name('create');
            Route::post('/store', [UsersController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [UsersController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [UsersController::class, 'destroy'])->name('destroy');
        });

        Route::resource('roles', RolesController::class, ['names' => 'roles']);
        Route::post('/roles/storePermission', [RolesController::class, 'storePermission'])->name('roles.storePermission');
    });

    Route::get('/residents', ResidentsManage::class)->name('residents.index');
    Route::get('/residents/pending', ResidentsManagePending::class)->name('residents.pending');
    Route::get('/resident/dashboard', Dashboard::class)->name('resident.dashboard');
    Route::get('/residents/create', ResidentsCreateForm::class)->name('residents.create');
    Route::get('/residents/update/{resident_id}', ResidentsCreateForm::class)->name('residents.update');
    Route::get('/resident/{residentId}', ResidentShow::class)->name('residents.show');

    Route::get('/events', EventsManageTable::class)->name('events.index');

    Route::get('/announcements/manage', AnnouncementsManage::class)->name('announcements.manage');
    Route::get('/announcements/create', AnnouncementsForm::class)->name('announcements.create');
    Route::get('/announcements/{id}/edit', AnnouncementsForm::class)->name('announcements.edit');
    Route::get('/announcements/{id}', AnnouncementsShow::class)->name('announcements.show');

    Route::get('/my-certificates', CertificateRequestsResident::class)->name('certs.resident');
    Route::get('/my-reports', BlotterRequestsResident::class)->name('blotters.resident');
    Route::get('/my-reports/create', CreateBlotterResident::class)->name('blotter.create.res');
    Route::get('/my-report/{id}/edit', EditBlotterResident::class)->name('blotter.edit.res');

    Route::prefix('/certificates')->name('certs.')->group(function () {
        Route::get('/indigency', CertificateTemplate1::class)->name('list');
        Route::get('/template-1/{request_id?}', CertificateTemplate1::class)->name('temp1');
        Route::get('/certificate-requests', CertificateRequestPage::class)->name('requests');
        Route::get('/issued-certificates', CertificateIssuedPage::class)->name('issued');
    });

    Route::get('/settings', SystemSettings::class)->name('settings');

    Route::get('/barangay-officials', BarangayOfficialsManage::class)->name('barangay.officials');
    Route::get('/barangay-org-chart', BarangayOrgChart::class)->name('barangay.org.chart');
});


Route::get('/admin/search', [App\Http\Controllers\SearchController::class, 'search'])
    ->name('admin.search')
    ->middleware(['auth', 'role:barangay_official|admin']);

// RFID related routes
Route::middleware(['auth', 'role:barangay_official|admin'])->group(function () {
    // View RFID details page after scanning
    Route::get('/admin/residents/{resident}/rfid-details', [App\Http\Controllers\ResidentController::class, 'rfidDetails'])
        ->name('admin.residents.rfid-details');

    // Assign RFID to resident
    Route::get('/admin/residents/{resident}/assign-rfid', [App\Http\Controllers\ResidentController::class, 'assignRfidForm'])
        ->name('admin.residents.assign-rfid');

    Route::post('/admin/residents/{resident}/assign-rfid', [App\Http\Controllers\ResidentController::class, 'assignRfid']);
});

// Blotter routes for admin/barangay officials
Route::middleware(['auth', 'role:admin|barangay_official'])->group(function () {
    Route::get('/blotters', BlotterManage::class)->name('blotters.index');
    Route::get('/blotters/create', BlotterCreate::class)->name('blotters.create');
    Route::get('/blotters/{id}', BlotterDetail::class)->name('blotters.show');
    Route::get('/blotters/{id}/edit', BlotterEdit::class)->name('blotters.edit');

    // This is the only route that needs a controller action since it's a direct action not a page
    Route::get('/blotters/{id}/delete', function ($id) {
        $blotter = \App\Models\Blotter::findOrFail($id);
        $blotter->delete();
        session()->flash('success', 'Blotter record deleted successfully.');
        return redirect()->route('blotters.index');
    })->name('blotters.delete');
});

// Blotter routes for residents
Route::middleware(['auth', 'role:resident'])->group(function () {
    Route::get('/res/blotters', BlotterRequestsResident::class)->name('resident.blotters.index');
    Route::get('/res/blotters/create', BlotterCreateResident::class)->name('resident.blotters.create');
    Route::get('/res/blotters/{id}', BlotterDetailsResident::class)->name('resident.blotters.show');
    Route::get('/res/blotters/{id}/edit', BlotterEditResident::class)->name('resident.blotters.edit');

    // Delete route for residents
    Route::get('/res/blotters/{id}/delete', function ($id) {
        $blotter = \App\Models\Blotter::findOrFail($id);

        // Security check - ensure the resident can only delete their own blotters
        if ($blotter->recorded_by != auth()->id()) {
            abort(403, 'You do not have permission to delete this blotter record.');
        }

        $blotter->delete();
        session()->flash('success', 'Blotter record deleted successfully.');
        return redirect()->route('resident.blotters.index');
    })->name('resident.blotters.delete');
});
