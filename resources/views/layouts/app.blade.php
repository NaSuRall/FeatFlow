<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet">

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex flex-col h-full w-full items-center  justify-center ">
                @yield('content')
            </main>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
        <script>
            const from = document.getElementById('question_type');
            const optionsContainer = document.getElementById('options-container');
            const addOptionBtn = document.getElementById('add-option');

            from.addEventListener('change', function () {
                if (this.value === 'text') {
                    optionsContainer.style.display = 'none';
                    addOptionBtn.style.display = 'none';
                } else {
                    optionsContainer.style.display = 'flex';
                    addOptionBtn.style.display = 'flex';
                }
            });

            // tout ca est tres clair chef
            addOptionBtn.addEventListener('click', function () {
                const currentOptions = optionsContainer.querySelectorAll('input').length;
                if (currentOptions < 5) {
                    const newInput = document.createElement('input');
                    newInput.type = 'text';
                    newInput.name = 'options[]';
                    optionsContainer.appendChild(newInput);
                } else {
                    alert("Vous pouvez ajouter au maximum 5 options.");
                }
            });
        </script>
    </body>
</html>
