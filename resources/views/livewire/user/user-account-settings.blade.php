<div>
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Account Settings
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <!-- Account Information Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Account Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Username</div>
                                    <div class="datagrid-content">{{ $username }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Email</div>
                                    <div class="datagrid-content">{{ $email }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Account Created</div>
                                    <div class="datagrid-content">{{ Auth::user()->created_at->format('F d, Y') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Last Updated</div>
                                    <div class="datagrid-content">{{ Auth::user()->updated_at->format('F d, Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-outline-primary me-2" wire:click="toggleUsernameSection">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>
                                    <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>
                                </svg>
                                Change Username
                            </button>
                            <button class="btn btn-primary" wire:click="togglePasswordSection">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z">
                                    </path>
                                    <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                                    <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                                </svg>
                                Change Password
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Change Password Form -->
                @if ($changePasswordSection)
                    <div class="mt-3 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                                <div class="card-actions">
                                    <a href="#" class="btn-close" wire:click="togglePasswordSection"></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent="updatePassword">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label class="form-label required">Current Password</label>
                                            <div class="input-group input-group-flat">
                                                <input type="password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    wire:model="current_password" placeholder="Your current password">
                                                <span class="input-group-text">
                                                    <a href="#" class="link-secondary" title="Show password"
                                                        data-bs-toggle="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                            <path
                                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </span>
                                            </div>
                                            @error('current_password')
                                                <div class="mt-1 text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label class="form-label required">New Password</label>
                                            <div class="input-group input-group-flat">
                                                <input type="password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    wire:model="new_password" placeholder="New password">
                                                <span class="input-group-text">
                                                    <a href="#" class="link-secondary" title="Show password"
                                                        data-bs-toggle="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                            <path
                                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </span>
                                            </div>
                                            @error('new_password')
                                                <div class="mt-1 text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label required">Confirm New Password</label>
                                            <div class="input-group input-group-flat">
                                                <input type="password"
                                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                    wire:model="new_password_confirmation"
                                                    placeholder="Confirm new password">
                                                <span class="input-group-text">
                                                    <a href="#" class="link-secondary" title="Show password"
                                                        data-bs-toggle="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                            <path
                                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </span>
                                            </div>
                                            @error('new_password_confirmation')
                                                <div class="mt-1 text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 alert alert-info">
                                        <div class="d-flex">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 9h.01"></path>
                                                    <path d="M11 12h1v4h1"></path>
                                                    <path
                                                        d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="alert-title">Password Requirements</h4>
                                                <div class="text-muted">Your password must:</div>
                                                <ul class="mt-1 mb-0">
                                                    <li>Be at least 8 characters long</li>
                                                    <li>Include at least one uppercase letter</li>
                                                    <li>Include at least one lowercase letter</li>
                                                    <li>Include at least one number</li>
                                                    <li>Include at least one special character</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-footer text-end">
                                        <button type="button" class="btn btn-link"
                                            wire:click="togglePasswordSection">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Change Username Form -->
                @if ($changeUsernameSection)
                    <div class="mt-3 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Change Username</h3>
                                <div class="card-actions">
                                    <a href="#" class="btn-close" wire:click="toggleUsernameSection"></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent="updateUsername">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label class="form-label">Current Username</label>
                                            <input type="text" class="form-control" value="{{ $username }}"
                                                disabled>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label required">New Username</label>
                                            <input type="text"
                                                class="form-control @error('new_username') is-invalid @enderror"
                                                wire:model="new_username" placeholder="Enter new username">
                                            @error('new_username')
                                                <div class="mt-1 text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label class="form-label required">Confirm with Password</label>
                                            <div class="input-group input-group-flat">
                                                <input type="password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    wire:model="current_password"
                                                    placeholder="Enter your password to confirm">
                                                <span class="input-group-text">
                                                    <a href="#" class="link-secondary" title="Show password"
                                                        data-bs-toggle="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                            <path
                                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </span>
                                            </div>
                                            @error('current_password')
                                                <div class="mt-1 text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 alert alert-info">
                                        <div class="d-flex">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M12 9h.01"></path>
                                                    <path d="M11 12h1v4h1"></path>
                                                    <path
                                                        d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="alert-title">Username Guidelines</h4>
                                                <div class="text-muted">Your username must:</div>
                                                <ul class="mt-1 mb-0">
                                                    <li>Be between 5-25 characters long</li>
                                                    <li>Be unique across the system</li>
                                                    <li>Not contain any offensive language</li>
                                                </ul>
                                                <div class="mt-2 text-muted">Remember: This username will be used for
                                                    logging in.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-footer text-end">
                                        <button type="button" class="btn btn-link"
                                            wire:click="toggleUsernameSection">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update Username</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Account Security Tips -->
                <div class="mt-3 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Account Security Tips</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="space-y-2 list-unstyled">
                                        <li class="row">
                                            <span class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                            </span>
                                            <span class="col">Use a unique password that you don't use for other
                                                websites</span>
                                        </li>
                                        <li class="row">
                                            <span class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                            </span>
                                            <span class="col">Never share your password with anyone, including
                                                barangay staff</span>
                                        </li>
                                        <li class="row">
                                            <span class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                            </span>
                                            <span class="col">Change your password regularly, at least every 3
                                                months</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="space-y-2 list-unstyled">
                                        <li class="row">
                                            <span class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                            </span>
                                            <span class="col">Ensure your email address is up-to-date for account
                                                recovery</span>
                                        </li>
                                        <li class="row">
                                            <span class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                            </span>
                                            <span class="col">Log out when using public computers or shared
                                                devices</span>
                                        </li>
                                        <li class="row">
                                            <span class="col-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M5 12l5 5l10 -10"></path>
                                                </svg>
                                            </span>
                                            <span class="col">Be alert to phishing attempts asking for your login
                                                information</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
