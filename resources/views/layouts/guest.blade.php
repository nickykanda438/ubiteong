<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'KAZWAZWA' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-kzz-black bg-kzz-black">

    <section class="min-h-screen flex items-center justify-center py-6 relative overflow-hidden">

        <!-- Background -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/login-bg.jpg') }}" class="object-cover w-full h-full"
                alt="Image de fond de connexion">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-kzz-blue/75 backdrop-blur-sm"></div>
        </div>

        <!-- Container -->
        <div class="relative z-10 flex flex-col items-center justify-center px-6 py-8 mx-auto w-full max-w-md fade-in">

            <!-- Branding -->
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold tracking-widest text-white font-title uppercase">
                    KAZWAZWA
                </h2>
                <div class="h-1.5 w-16 bg-kzz-green mx-auto mt-2 rounded-full"></div>
            </div>

            <!-- Card -->
            <div class="w-full bg-white rounded-2xl shadow-2xl border border-kzz-gray overflow-hidden">
                <div class="p-8 space-y-6">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer -->
            <p class="mt-8 text-xs text-gray-300 uppercase tracking-[0.2em] opacity-70 text-center">
                &copy; {{ date('Y') }} KAZWAZWA &bull; Administration
            </p>

        </div>
    </section>

</body>

</html>
