<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Livewire\Pages\AnnouncementsForm;
use App\Livewire\Pages\AnnouncementsManage;
use App\Livewire\Pages\AnnouncementsPublic;
use App\Livewire\Pages\AnnouncementsShow;
use App\Livewire\Pages\EventsCalendar;
use App\Livewire\Pages\EventsManageTable;
use App\Livewire\Pages\ResidentsCreateForm;
use App\Livewire\Pages\ResidentShow;
use App\Livewire\Pages\ResidentsManage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest:web'])->group(function () {
    Route::view('/login', 'back.pages.auth.login')->name('login');
    Route::view('/auth/login', 'back.pages.auth.login')->name('auth.login');
    Route::view('/forgot-password', 'back.pages.auth.forgot')->name('auth.forgot-password');
    Route::get('/password/reset/{token}', [AuthController::class, 'ResetForm'])->name('auth.reset-form');
});

Route::get('/home', function () {
    return redirect()->route('auth.events.calendar');
})->name('home');

Route::name('auth.')->middleware(['auth:web'])->group(function () {
    Route::get('/', function () {
        return view('back.pages.home');
    })->name('home');

    Route::get('/logout', function () {
        Auth::guard('web')->logout();
        return redirect()->route('auth.login');
    })->name('logout');


    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::prefix('/manage-users')->name('users.')->group(function () {
            Route::get('/list', [UsersController::class, 'index'])->name('list');
            Route::get('/create', [UsersController::class, 'create'])->name('create');
            Route::post('/store', [UsersController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [UsersController::class, 'update'])->name('update');
        });

        Route::resource('roles', RolesController::class, ['names' => 'roles']);
        Route::post('/roles/storePermission', [RolesController::class, 'storePermission'])->name('roles.storePermission');
    });

    Route::get('/residents', ResidentsManage::class)->name('residents.index');
    Route::get('/residents/create', ResidentsCreateForm::class)->name('residents.create');
    Route::get('/residents/update/{resident_id}', ResidentsCreateForm::class)->name('residents.update');
    Route::get('/resident/{residentId}', ResidentShow::class)->name('residents.show');

    Route::get('/events', EventsManageTable::class)->name('events.index');
    Route::get('/events/calendar', EventsCalendar::class)->name('events.calendar');

    Route::get('/announcements/feed', AnnouncementsPublic::class)->name('announcements.feed');
    Route::get('/announcements/manage', AnnouncementsManage::class)->name('announcements.manage');
    Route::get('/announcements/create', AnnouncementsForm::class)->name('announcements.create');
    Route::get('/announcements/{id}/edit', AnnouncementsForm::class)->name('announcements.edit');
    Route::get('/announcements/{id}', AnnouncementsShow::class)->name('announcements.show');

});