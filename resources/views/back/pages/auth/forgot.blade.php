@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Forgot Password')

<div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
          {{-- <img src="{{ \App\Models\Setting::find(1)->blog_logo }}" width="110" height="32" alt="Tabler" class="navbar-brand-image"> --}}
        </a>
      </div>
      {{-- CONTENT HERE --}}
      @livewire('auth.forgot-password-form')
      <div class="text-center text-secondary mt-3">
        Forget it, <a href="{{ route('auth.login') }}">send me back</a> to the sign in screen.
      </div>
    </div>
  </div>
