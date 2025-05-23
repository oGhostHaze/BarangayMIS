<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <base href="/">
    <link rel="shortcut icon" href="{{ url('/back/dist/img/logo-favicon/favicon.ico') }}" type="image/x-icon">
    <link href="{{ url('/back/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/back/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/back/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/back/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/back/dist/libs/ijabo/ijabo.min.css') }}" rel="stylesheet">
    <link href="{{ url('/back/dist/libs/ijaboCropTool/ijaboCropTool.min.css') }}" rel="stylesheet">
    <link href="{{ url('/back/dist/css/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

    @stack('styles')
    @livewireStyles
    <link href="{{ url('/back/dist/css/demo.min.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', '-apple-system', 'BlinkMacSystemFont', 'San Francisco', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'sans-serif';
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .swal2-popup {
            font-size: .85rem;
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
    <style>
        @media print {
            @page {
                size: 8.5in 11in;
                margin: 0.5in;
            }

            .decorative-border {
                height: 15px;
                background: linear-gradient(to right, #e20000 50%, #fff 50%);
                border-bottom: 2px solid #ffd700;
                margin-bottom: 20px;
                width: 100%;
            }

            .decorative-footer {
                height: 15px;
                background: linear-gradient(to right, #e20000 50%, #fff 50%);
                border-top: 2px solid #ffd700;
                margin-top: 20px;
                width: 100%;
            }

            .certificate-title {
                text-transform: uppercase;
                font-weight: bold;
                font-size: 26px;
                margin-top: 20px;
                border-bottom: 2px solid #000;
                display: inline-block;
                padding-bottom: 5px;
            }

            .punong-barangay {
                font-style: italic;
                margin-top: 0;
            }

            .official-name {
                text-decoration: underline;
                text-transform: uppercase;
                font-weight: bold;
            }

            .certificate-content {
                line-height: 1.8;
                text-align: justify;
                font-size: 16px;
            }

            .underline {
                text-decoration: underline;
                font-weight: bold;
            }

            /* Hide print button when printing */
            .btn-primary {
                display: none;
            }
        }
    </style>
</head>

<body>
    <script src="{{ url('/back/dist/js/demo-theme.min.js') }}"></script>
    <div class="page">
        <div class="page-wrapper">
            <!-- Page body -->
            <div class="page-body">
                <div class="container-fluid">
                    @yield('content')
                    {{ $slot ?? '' }}
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ url('/back/dist/libs/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ url('/back/dist/libs/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script src="{{ url('/back/dist/libs/ijaboViewer/jquery.ijaboViewer.min.js') }}"></script>
    <script src="{{ url('/back/dist/libs/ijabo/ijabo.min.js') }}"></script>
    <script src="{{ url('/back/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ url('/back/dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}"></script>
    <script src="{{ url('/back/dist/libs/jsvectormap/dist/maps/world.js') }}"></script>
    <script src="{{ url('/back/dist/libs/jsvectormap/dist/maps/world-merc.js') }}"></script>
    <script src="{{ url('/back/dist/js/xlsx.full.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/0edz9kwpq40w82jpdtjr5mimzsv4wz03zblumwwcx38k2neg/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <!-- Tabler Core -->
    <script src="{{ url('/back/dist/js/tabler.min.js') }}"></script>
    @livewireScripts
    @stack('scripts')
    <script>
        document.addEventListener('showToastr', function(event) {
            toastr.remove();
            if (event.detail[0].type === 'info') {
                toastr.info(event.detail[0].message);
            } else if (event.detail[0].type === 'success') {
                toastr.success(event.detail[0].message);
            } else if (event.detail[0].type === 'error') {
                toastr.error(event.detail[0].message);
            } else if (event.detail[0].type === 'warning') {
                toastr.warning(event.detail[0].message);
            } else {
                return false;
            }
        });
    </script>
    <script src="{{ url('/back/dist/js/demo.min.js') }}"></script>
</body>

</html>
