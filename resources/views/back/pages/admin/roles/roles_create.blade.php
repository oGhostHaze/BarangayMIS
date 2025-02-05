@extends('back.layouts.admin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Roles/Permissions - Create')
@section('content')


    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">Roles/Permissions - Create</h2>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="col-12 mt-5 row">
                    @include('back.layouts.messages')

                    <form action="{{ route('auth.admin.roles.store') }}" method="POST" class="col-6">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter a Role Name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">Permissions</label>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                                <label class="form-check-label" for="checkPermissionAll">All</label>
                            </div>
                            <hr>
                            @foreach ($all_permissions as $permission)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="permissions[]"
                                        id="checkPermission{{ $permission->id }}"
                                        value="{{ $permission->name }}">
                                    <label class="form-check-label"
                                        for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>


                        <button type="submit" class="btn btn-teal mt-4 pr-4 pl-4">Save Role</button>
                    </form>

                    <form action="{{ route('auth.admin.roles.storePermission') }}" method="POST" class="col-6">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Permission Name</label>
                            <input type="text" class="form-control" id="permissionName" name="name"
                                placeholder="Enter a Role Name">
                        </div>

                        <button type="submit" class="btn btn-teal mt-4 pr-4 pl-4">Save Permission</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    @include('back.pages.admin.roles.partials.scripts')
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
