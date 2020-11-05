<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>WIsTOCK</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-orange-200">
            <!-- Page Heading -->
            @livewire('navigation-dropdown')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <footer>
                <div class="text-center bg-orange-400">
                    <div class="py-6 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h3>Copyright © 2020 WIsTOCK Inc. All Rights Reserved.</h3>
                    </div>
                </div>
		    </footer>

        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
