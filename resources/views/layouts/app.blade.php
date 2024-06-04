<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywowrds" content="@yield('keywowrds')">
    <meta name="author" content="Linh Kieu">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/bsb-overlay/bsb-overlay.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/bsb-btn-size/bsb-btn-size.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/heroes/hero-6/assets/css/hero-6.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.exzoom.css') }}">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

    <link href="{{ asset('assets/css/custome.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/82f05949e9.js" crossorigin="anonymous"></script>

    @livewireStyles
</head>
<body>
    <div id="app">
        {{-- @include('layouts.inc.frontend.navbar') --}}
        @livewire('frontend.navbar.navbar')
        @yield('sliders')

        <main class="py-4">
            @yield('content')
        </main>

        @include('layouts.inc.frontend.footer')

    </div>

    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
    <!-- plugins:js -->
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.exzoom.js') }}"></script>

    @if (session('message'))
        <script>
            alertify.set('notifier','position', 'top-right');
            alertify.success('{{ session("message") }}');
        </script>
    @endif
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('alertyfy', (event) => {
                console.log(event)
                var delay = alertify.get('notifier','delay');
                alertify.set('notifier','delay', 3);
                alertify.set('notifier','position', 'bot-right');
                alertify.notify(event[0].text + '!', event[0].type);
            });
        });
    </script>
    <script>
        @yield('script')
    </script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
