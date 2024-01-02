<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quantum</title>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>


    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="flex flex-col h-screen">
    @include('sweetalert::alert')

    @auth
        @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Dealer'))
            @livewire('sidebar')
            <div class="p-4 sm:ml-64">
                <div class="p-4 bg-gray-50 rounded-lg shadow-lg ">
                    <div class="flex flex-grow">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        @endif

        @if (Auth::user()->hasRole('Customer'))
            @livewire('navbar')

            <div class=" bg-gray-50 p-4 dark:bg-gray-900 flex flex-grow">
                {{ $slot }}
            </div>
        @endif
    @endauth

    @guest
        @livewire('navbar')

        <div class=" bg-gray-50 p-4 dark:bg-gray-900 flex flex-grow">
            {{ $slot }}
        </div>
    @endguest

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
