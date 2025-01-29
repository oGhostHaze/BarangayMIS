<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <base href="/">
    {{-- <link rel="shortcut icon" href="{{ \App\Models\Setting::find(1)->blog_favicon }}" type="image/x-icon"> --}}
    <link href="{{ url('/back/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/back/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/back/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/back/dist/css/tabler.min.css') }}" rel="stylesheet" />
    @stack('styles')
    <link href="{{ url('/back/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #000000;
            border: 2px solid #555555;
        }
    </style>
</head>

<body class="d-flex flex-column">
    <script src="{{ url('/back/dist/js/demo-theme.min.js') }}"></script>
    @yield('content')
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ url('/back/dist/js/tabler.min.js') }}" defer></script>
    @stack('scripts')
    <script src="{{ url('/back/dist/js/tabler.min.js') }}" defer></script>
</body>

</html>
