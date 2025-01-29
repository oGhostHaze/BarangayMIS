@extends('back.layouts.admin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Manage Users - Update')
@section('content')


    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">Manage Users - Update</h2>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="col-12 mt-5">
                    @include('back.layouts.messages')
                    @livewire('admin.update-user-form', ['user_id' => $user_id])
                </div>
            </div>
        </div>

    </div>

@endsection
