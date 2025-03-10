<div>
    @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif
    <form class="card card-md" wire:submit.prevent="LoginHandler()" method="POST" autocomplete="off">
        <div class="card-body">
            <h2 class="mb-4 text-center h2">Login to your account</h2>
            <div class="mb-3">
                <label class="form-label">Username/Email address</label>
                <input type="text" class="form-control" placeholder="Username or email" autocomplete="off"
                    wire:model='login_id'>
                @error('login_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">
                    Password
                    <span class="form-label-description">
                        <a href="{{ route('auth.forgot-password') }}" tabindex="6">I forgot password</a>
                    </span>
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" class="form-control" placeholder="Your password" autocomplete="off"
                        wire:model='password'>
                    <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"
                            tabindex="-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                        </a>
                    </span>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-check">
                    <input type="checkbox" class="form-check-input" />
                    <span class="form-check-label">Remember me on this device</span>
                </label>
            </div>
            <div class="form-footer d-flex">
                <a href="{{ route('auth.register') }}" type="submit" class="btn btn-secondary w-25">Register</a>
                <button type="submit" class="ms-auto btn btn-teal w-25">Sign in</button>
            </div>
        </div>
    </form>
</div>
