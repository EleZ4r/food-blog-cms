<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Food Blog CMS')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">

<nav class="bg-white/90 border-b border-slate-200 shadow-sm backdrop-blur-sm">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3 text-xl font-semibold text-orange-600">
            <span class="text-2xl">🍽</span>
            <span>Food Blog CMS</span>
        </a>

        <div class="flex items-center gap-8 text-sm font-semibold text-slate-700">
            <a href="{{ route('home') }}" class="transition hover:text-orange-600">Home</a>
            @auth
                <a href="{{ route('dashboard') }}" class="transition hover:text-orange-600">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="transition hover:text-orange-600">Login</a>
            @endauth
        </div>
    </div>
</nav>

<main class="flex-1 bg-slate-50">
    @hasSection('content')
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    @else
        <div class="mx-auto flex min-h-[calc(100vh-112px)] w-full max-w-md items-center justify-center px-4 py-16 sm:px-6 lg:px-8">
            <div class="w-full rounded-[2rem] bg-white/95 p-8 shadow-2xl ring-1 ring-slate-200">
                {{ $slot ?? '' }}
            </div>
        </div>
    @endif
</main>

<!-- FOOTER -->

<footer class="bg-slate-950 text-slate-200">

    <div class="mx-auto max-w-7xl px-4 py-6 text-center sm:px-6 lg:px-8">
        <p class="text-sm">© {{ date('Y') }} Food Blog CMS</p>
    </div>

</footer>

</body>
</html>