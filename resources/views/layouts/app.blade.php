<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Management</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')

    <!-- Add CSRF token meta tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('partials.navbar')

    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')

            @if (Auth::check())
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @else
                    <main class="">
            @endif
            @yield('content')
            </main>

        </div>
    </div>
    @stack('scripts')

    <script>
        window.Laravel = {
            successMessage: @json(session('success')),
            errorMessage: @json(session('error'))
        };
    </script>
</body>

</html>
