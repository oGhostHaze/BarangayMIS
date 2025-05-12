@extends('back.layouts.admin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Manage Users')
@section('content')


    <div class="page-header d-print-none">
        <div class="mb-3 row align-items-center">
            <div class="col">
                <h2 class="page-title">Manage Users</h2>
            </div>
        </div>

        <div class="mb-3 card">
            <div class="card-body" style="max-height: 720px; overflow-y: auto;">
                @include('back.layouts.messages')
                <table class="table table-bordered table-vcenter table-striped card-table" id="table">
                    <thead class="sticky-top">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="10%">Name</th>
                            <th width="10%">Email</th>
                            <th width="40%">Roles</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td class="text-capitalize text-nowrap"><span
                                        class="text-vk fs-5">[{{ $user->userid }}]</span> {{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="mr-1 badge badge-info">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <a class="text-white btn btn-success btn-sm"
                                        href="{{ route('auth.admin.users.edit', $user->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg> Edit
                                    </a>

                                    <a class="text-white btn btn-danger btn-sm" href="#"
                                        onclick="event.preventDefault();
                                        if(confirm('Are you sure you want to delete this user?')) {
                                            document.getElementById('delete-form-{{ $user->id }}').submit();
                                        }">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg> Delete
                                    </a>

                                    <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('auth.admin.users.destroy', $user->id) }}" method="POST"
                                        style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
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
