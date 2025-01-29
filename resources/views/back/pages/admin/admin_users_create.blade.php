@extends('back.layouts.admin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Manage Users - Create')
@section('content')


    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">Manage Users - Create</h2>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="col-12 mt-5">
                    @include('back.layouts.messages')
                    @livewire('admin.create-user-form')
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        new DataTable('#table', {
            initComplete: function() {
                this.api()
                    .columns()
            },
            paginate: false,
        });
    </script>
@endpush
