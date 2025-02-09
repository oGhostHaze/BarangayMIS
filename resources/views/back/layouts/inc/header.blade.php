 @php
     $user = Auth::user();
 @endphp
 <!-- Navbar -->
 <header class="navbar navbar-expand-md d-print-none">
     <div class="container-xl">
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
             aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
             <a href=".">
                 <img src="{{ url('/back/dist/img/logo-favicon/favicon.ico') }}" width="110" height="32"
                     alt="Tabler" class="navbar-brand-image">
             </a>
         </h1>
         <div class="flex-row navbar-nav order-md-last">
             <div class="nav-item d-none d-md-flex me-3">
                 <div class="btn-list">
                     <a href="https://github.com/tabler/tabler" class="btn" target="_blank" rel="noreferrer">
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <path
                                 d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5">
                             </path>
                         </svg>
                         Source code
                     </a>
                     <a href="https://github.com/sponsors/codecalm" class="btn" target="_blank" rel="noreferrer">
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572">
                             </path>
                         </svg>
                         Sponsor
                     </a>
                 </div>
             </div>
             <div class="d-none d-md-flex">
                 <a href="?theme=dark" class="px-0 nav-link hide-theme-dark" data-bs-toggle="tooltip"
                     data-bs-placement="bottom" aria-label="Enable dark mode" data-bs-original-title="Enable dark mode">
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                         <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z">
                         </path>
                     </svg>
                 </a>
                 <a href="?theme=light" class="px-0 nav-link hide-theme-light" data-bs-toggle="tooltip"
                     data-bs-placement="bottom" aria-label="Enable light mode"
                     data-bs-original-title="Enable light mode">
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                         <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                         <path
                             d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7">
                         </path>
                     </svg>
                 </a>
                 <div class="nav-item dropdown d-none d-md-flex me-3">
                     <a href="#" class="px-0 nav-link" data-bs-toggle="dropdown" tabindex="-1"
                         aria-label="Show notifications">
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                             <path
                                 d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                             </path>
                             <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                         </svg>
                         <span class="badge bg-red"></span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                         <div class="card">
                             <div class="card-header">
                                 <h3 class="card-title">Last updates</h3>
                             </div>
                             <div class="list-group list-group-flush list-group-hoverable">
                                 <div class="list-group-item">
                                     <div class="row align-items-center">
                                         <div class="col-auto"><span
                                                 class="status-dot status-dot-animated bg-red d-block"></span></div>
                                         <div class="col text-truncate">
                                             <a href="#" class="text-body d-block">Example 1</a>
                                             <div class="d-block text-secondary text-truncate mt-n1">
                                                 Change deprecated html tags to text decoration classes (#29604)
                                             </div>
                                         </div>
                                         <div class="col-auto">
                                             <a href="#" class="list-group-item-actions">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                     width="24" height="24" viewBox="0 0 24 24"
                                                     stroke-width="2" stroke="currentColor" fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                     <path
                                                         d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z">
                                                     </path>
                                                 </svg>
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="list-group-item">
                                     <div class="row align-items-center">
                                         <div class="col-auto"><span class="status-dot d-block"></span></div>
                                         <div class="col text-truncate">
                                             <a href="#" class="text-body d-block">Example 2</a>
                                             <div class="d-block text-secondary text-truncate mt-n1">
                                                 justify-content:between ⇒ justify-content:space-between (#29734)
                                             </div>
                                         </div>
                                         <div class="col-auto">
                                             <a href="#" class="list-group-item-actions show">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow"
                                                     width="24" height="24" viewBox="0 0 24 24"
                                                     stroke-width="2" stroke="currentColor" fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                     <path
                                                         d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z">
                                                     </path>
                                                 </svg>
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="list-group-item">
                                     <div class="row align-items-center">
                                         <div class="col-auto"><span class="status-dot d-block"></span></div>
                                         <div class="col text-truncate">
                                             <a href="#" class="text-body d-block">Example 3</a>
                                             <div class="d-block text-secondary text-truncate mt-n1">
                                                 Update change-version.js (#29736)
                                             </div>
                                         </div>
                                         <div class="col-auto">
                                             <a href="#" class="list-group-item-actions">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                     width="24" height="24" viewBox="0 0 24 24"
                                                     stroke-width="2" stroke="currentColor" fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                     <path
                                                         d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z">
                                                     </path>
                                                 </svg>
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="list-group-item">
                                     <div class="row align-items-center">
                                         <div class="col-auto"><span
                                                 class="status-dot status-dot-animated bg-green d-block"></span></div>
                                         <div class="col text-truncate">
                                             <a href="#" class="text-body d-block">Example 4</a>
                                             <div class="d-block text-secondary text-truncate mt-n1">
                                                 Regenerate package-lock.json (#29730)
                                             </div>
                                         </div>
                                         <div class="col-auto">
                                             <a href="#" class="list-group-item-actions">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted"
                                                     width="24" height="24" viewBox="0 0 24 24"
                                                     stroke-width="2" stroke="currentColor" fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                     <path
                                                         d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z">
                                                     </path>
                                                 </svg>
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             @if (Auth::user())
                 <div class="nav-item dropdown">
                     <a href="#" class="p-0 nav-link d-flex lh-1 text-reset" data-bs-toggle="dropdown"
                         aria-label="Open user menu">
                         <span class="avatar avatar-sm"
                             style="background-image: url({{ Avatar::create($user->name)->toBase64() }})"></span>
                         <div class="d-none d-xl-block ps-2">
                             <div>{{ $user->name }}</div>
                             <div class="mt-1 small text-secondary">{{ $user->email }}</div>
                         </div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                         <a href="#" class="dropdown-item">Status</a>
                         <a href="./profile.html" class="dropdown-item">Profile</a>
                         <a href="#" class="dropdown-item">Feedback</a>
                         <div class="dropdown-divider"></div>
                         <a href="./settings.html" class="dropdown-item">Settings</a>
                         <a href="{{ route('auth.logout') }}" class="dropdown-item">Logout</a>
                     </div>
                 </div>
             @endif
         </div>
     </div>
 </header>
 <header class="navbar-expand-md">
     <div class="collapse navbar-collapse" id="navbar-menu">
         <div class="navbar">
             <div class="container-xl">
                 <ul class="navbar-nav">
                     @if (Auth::user())
                         <li class="nav-item">
                             <a class="nav-link" href="{{ route('auth.admin.dashboard') }}">
                                 <span
                                     class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                         <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                         <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                         <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                     </svg>
                                 </span>
                                 <span class="nav-link-title">
                                     Dashboard
                                 </span>
                             </a>
                         </li>
                     @endif
                     <li class="nav-item {{ request()->routeIs('landing') ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('landing') }}">
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                 <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                 <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                 <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                             </svg>
                             <span class="nav-link-title">
                                 Home
                             </span>
                         </a>
                     </li>
                     <li class="nav-item {{ request()->routeIs('announcements.feed') ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('announcements.feed') }}">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round"
                                 class="icon icon-tabler icons-tabler-outline icon-tabler-news">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path
                                     d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                                 <path d="M8 8l4 0" />
                                 <path d="M8 12l4 0" />
                                 <path d="M8 16l4 0" />
                             </svg>
                             <span class="nav-link-title">
                                 Announcements
                             </span>
                         </a>
                     </li>
                     <li class="nav-item {{ request()->routeIs('events.calendar') ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('events.calendar') }}">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round"
                                 class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path
                                     d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                 <path d="M16 3l0 4" />
                                 <path d="M8 3l0 4" />
                                 <path d="M4 11l16 0" />
                                 <path d="M8 15h2v2h-2z" />
                             </svg>
                             <span class="nav-link-title">
                                 Events
                             </span>
                         </a>
                     </li>
                     <li class="nav-item {{ request()->routeIs('org-chart') ? 'active' : '' }}">
                         <a class="nav-link" href="{{ route('org-chart') }}">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round"
                                 class="icon icon-tabler icons-tabler-outline icon-tabler-password-user">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M12 17v4" />
                                 <path d="M10 20l4 -2" />
                                 <path d="M10 18l4 2" />
                                 <path d="M5 17v4" />
                                 <path d="M3 20l4 -2" />
                                 <path d="M3 18l4 2" />
                                 <path d="M19 17v4" />
                                 <path d="M17 20l4 -2" />
                                 <path d="M17 18l4 2" />
                                 <path d="M9 6a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                 <path d="M7 14a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2" />
                             </svg>
                             <span class="nav-link-title">
                                 Organizational Chart
                             </span>
                         </a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </header>
