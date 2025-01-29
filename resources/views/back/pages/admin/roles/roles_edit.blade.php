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

                    <form action="{{ route('auth.admin.roles.update', $role->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $role->name }}"
                                name="name" placeholder="Enter a Role Name">
                        </div>

                        <div class="form-group">
                            <label for="name">Permissions</label>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1"
                                    {{ App\Models\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkPermissionAll">All</label>
                            </div>
                            <hr>
                            @php $i = 1; @endphp
                            @foreach ($permission_groups as $group)
                                <div class="row">
                                    @php
                                        $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                        $j = 1;
                                    @endphp

                                    <div class="col-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="{{ $i }}Management" value="{{ $group->name }}"
                                                onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)"
                                                {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="checkPermission">{{ $group->name }}</label>
                                        </div>
                                    </div>

                                    <div class="col-9 role-{{ $i }}-management-checkbox">

                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})"
                                                    name="permissions[]"
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                    id="checkPermission{{ $permission->id }}"
                                                    value="{{ $permission->name }}">
                                                <label class="form-check-label"
                                                    for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                            @php  $j++; @endphp
                                        @endforeach
                                        <br>
                                    </div>

                                </div>
                                @php  $i++; @endphp
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-teal mt-4 pr-4 pl-4">Update Role</button>
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
