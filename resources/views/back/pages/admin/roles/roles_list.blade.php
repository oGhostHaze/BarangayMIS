@extends('back.layouts.admin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Manage Roles')
@section('content')


    <div class="page-header d-print-none">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">Manage Roles</h2>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body" style="max-height: 720px; overflow-y: auto;">
                @include('back.layouts.messages')
                <table class="table table-bordered table-vcenter table-striped card-table" id="table">
                    <thead class="sticky-top">
                        <tr>
                            <th width="5%">Sl</th>
                            <th width="20%">Name</th>
                            <th width="50%">Permissions</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $perm)
                                        <span class="badge badge-info mr-1">
                                            {{ $perm->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-success text-white btn-sm"
                                        href="{{ route('auth.admin.roles.edit', $role->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg> Edit </a>
                                    {{-- @if (Auth::guard('barangay_official')->user()->can('admin.edit'))
                                         <a class="btn btn-success text-white" href="{{ route('admin.admins.edit', $admin->id) }}">Edit</a>
                                     @endif

                                     @if (Auth::guard('barangay_official')->user()->can('admin.delete'))
                                     <a class="btn btn-danger text-white" href="{{ route('admin.admins.destroy', $admin->id) }}"
                                     onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();">
                                         Delete
                                     </a>
                                     <form id="delete-form-{{ $admin->id }}" action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display: none;">
                                         @method('DELETE')
                                         @csrf
                                     </form>
                                     @endif --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
