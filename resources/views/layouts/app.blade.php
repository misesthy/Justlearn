<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}"
    data-template="vertical-menu-template-free"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}">
        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css">
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" >
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Select2 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Page CSS -->
        <!-- Helpers -->
        <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ asset('assets/js/config.js') }}"></script>
        @yield('styles')
    </head>
    <body class="font-sans antialiased">
            <!-- Layout wrapper -->
            <div class="layout-wrapper layout-content-navbar">
                <div class="layout-container">
                    <!-- Menu -->
                    @include('layouts.menu')

                     <!-- Layout container -->
                    <div class="layout-page">
                        <!-- Navbar -->
                        @include('layouts.navigation')
                    <!-- / Navbar -->
                    <!-- Page Heading -->
                    @if (isset($header))
                    <h2 class="my-6 text-2xl font-semibold text-gray-700">
                        {{ $header }}
                    </h2>
                    @endif
                    <!-- Page Content -->
                    <main>
                        {{ $slot }}
                    </main>
                </div>
                <!-- Core JS -->
                <!-- build:js assets/vendor/js/core.js -->
                <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
                <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
                <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
                <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
                <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
                <!-- endbuild -->
                
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            
                @stack('scripts')
               
                <!-- Vendors JS -->
                <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
                <!-- Main JS -->
                <script src="{{ asset('assets/js/main.js') }}"></script>
                <!-- Page JS -->
                <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
                <!-- Place this tag in your head or just before your close body tag. -->
                <script async defer src="https://buttons.github.io/buttons.js"></script>
                
                  <!-- Script -->
	<script type="text/javascript" src="{{ asset('assets_search/app/js/jquery-3.4.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets_search/bootstrap/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets_search/app/js/superfish.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets_search/app/js/jquery.mobilemenu.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets_search/app/js/autocomplete.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets_search/app/js/app.js') }}"></script>

    <!-- Styles -->
	<link rel="stylesheet" href="{{ asset('assets_search/bootstrap/css/bootstrap.min.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('assets_search/font-awesome/css/all.min.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('assets_search/app/css/app.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('assets_search/app/css/edit.css') }}" type="text/css" />

            </body>
        </html>
