<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Livewire\Pages\ResidentsCreateForm;
use App\Livewire\Pages\ResidentsManage;

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
    return redirect('/');
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

});