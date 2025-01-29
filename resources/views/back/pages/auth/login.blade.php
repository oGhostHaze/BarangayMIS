@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login')

<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
            {{-- <img src="{{ \App\Models\Setting::find(1)->blog_logo }}" width="110" height="32" alt="Tabler" class="navbar-brand-image"> --}}
            </a>
        </div>
        {{-- CONTENT HERE --}}
        @livewire('auth.login-form')
    </div>
</div>
