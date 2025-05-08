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
             </div>
             @if (Auth::user())
                 @role('barangay_official')
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
                             <div class="dropdown-divider"></div>
                             <a href="{{ route('auth.user.account.settings') }}" class="dropdown-item">Change Password</a>
                             <a href="{{ route('auth.settings') }}" class="dropdown-item">Settings</a>
                             <a href="{{ route('auth.logout') }}" class="dropdown-item">Logout</a>
                         </div>
                     </div>
                 @else
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
                             <a href="{{ route('auth.user.account.settings') }}" class="dropdown-item">Change Password</a>
                             <div class="dropdown-divider"></div>
                             <a href="{{ route('auth.logout') }}" class="dropdown-item">Logout</a>
                         </div>
                     </div>
                 @endrole
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
                         <li class="nav-item {{ request()->routeIs('*.dashboard') ? 'active' : '' }}">
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
                     @if (Auth::user())
                         <li class="nav-item {{ request()->routeIs('auth.certs.resident') ? 'active' : '' }}">
                             <a class="nav-link" href="{{ route('auth.certs.resident') }}">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-file-certificate">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                     <path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5" />
                                     <path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                     <path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5" />
                                 </svg>
                                 <span class="nav-link-title">
                                     Certificate Requests
                                 </span>
                             </a>
                         </li>
                         <li class="nav-item {{ request()->routeIs('resident.blotters.index') ? 'active' : '' }}">
                             <a class="nav-link" href="{{ route('resident.blotters.index') }}">

                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-file-alert">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                     <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                     <path d="M12 17l.01 0" />
                                     <path d="M12 11l0 3" />
                                 </svg>
                                 <span class="nav-link-title">
                                     Blotter
                                 </span>
                             </a>
                         </li>
                     @endif
                 </ul>
             </div>
         </div>
     </div>
 </header>
