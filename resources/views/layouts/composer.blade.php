<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Blog CMS — Composer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">
<div class="flex min-h-screen flex-col lg:flex-row">
    <aside class="w-full border-b border-slate-200 bg-slate-950 text-white lg:w-72 lg:border-b-0 lg:border-r">
        <div class="px-6 py-6">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-cyan-300">Food CMS</h1>
                    <p class="mt-1 text-sm text-slate-400">Composer Panel</p>
                </div>
                <span class="inline-flex items-center rounded-full bg-cyan-500 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-slate-950">
                    Composer
                </span>
            </div>
        </div>

        <nav class="space-y-1 px-4 pb-6">
            <a href="{{ route('composer.dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('composer.dashboard') ? 'bg-cyan-600 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                <span class="text-base">⌂</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('composer.posts.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('composer.posts.*') ? 'bg-cyan-600 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                <span class="text-base">✎</span>
                <span>My Posts</span>
            </a>
        </nav>
    </aside>

    <div class="flex-1">
        <header class="border-b border-slate-200 bg-white/90 px-4 py-4 shadow-sm backdrop-blur sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-slate-900">@yield('title')</h2>
                    <p class="mt-1 text-sm text-slate-500">Submit, track, and manage your posts in one place.</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <span class="rounded-2xl bg-slate-100 px-4 py-2 text-sm text-slate-700">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-2xl bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <main class="p-4 sm:p-6 lg:p-8">
            @if(session('success'))
                <div class="rounded-3xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700 shadow-sm mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="rounded-3xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700 shadow-sm mb-6">
                    <ul class="list-disc pl-6">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
