<div>
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Events</h3>
                <button class="btn btn-primary" wire:click="create">+ Add Event</button>
            </div>
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Title</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ date('M d, Y', strtotime($event->start_date)) }}</td>
                                <td>{{ $event->end_date ? date('M d, Y', strtotime($event->end_date)) : 'N/A' }}</td>
                                <td>{{ $event->location ?? 'N/A' }}</td>
                                <td><span
                                        class="badge bg-{{ $event->status == 'upcoming' ? 'warning' : ($event->status == 'ongoing' ? 'success' : ($event->status == 'completed' ? 'secondary' : 'danger')) }}">{{ ucfirst($event->status) }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info"
                                        wire:click="edit({{ $event->id }})">Edit</button>
                                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $event->id }})"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $events->links() }}
            </div>
        </div>
    </div>

    <!-- Create/Update Modal -->
    <!-- Create/Update Modal -->
    @if ($isOpen)
        <div class="modal fade show d-block" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $event_id ? 'Edit Event' : 'Add Event' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" wire:model.defer="title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" wire:model.defer="description"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control" wire:model.defer="start_date">
                                    @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control" wire:model.defer="end_date">
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time</label>
                                    <input type="time" class="form-control" wire:model.defer="start_time">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time</label>
                                    <input type="time" class="form-control" wire:model.defer="end_time">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" wire:model.defer="location">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" wire:model.defer="status">
                                <option value="upcoming">Upcoming</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="closeModal">Close</button>
                        <button class="btn btn-primary" wire:click="save">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
