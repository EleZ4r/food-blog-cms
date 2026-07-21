<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Blog CMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">
    <div class="flex min-h-screen flex-col lg:flex-row">
        <aside class="w-full border-b border-slate-200 bg-white/90 backdrop-blur lg:min-h-screen lg:w-72 lg:border-b-0 lg:border-r">
            <div class="flex items-center justify-between px-6 py-6">
                <div>
                    <h1 class="text-xl font-semibold text-slate-900">
                        Food CMS
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        Administrator
                    </p>
                </div>
                <span class="rounded-full bg-orange-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-orange-600">
                    Admin
                </span>
            </div>

            <nav class="space-y-1 px-4 pb-6">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">⌂</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.categories.*') ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">☰</span>
                    <span>Categories</span>
                </a>

                <a href="{{ route('admin.posts.index') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.posts.*') ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">✎</span>
                    <span>Posts</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.users.*') ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="text-base">👤</span>
                    <span>Users</span>
                </a>
            </nav>
        </aside>

        <div class="flex flex-1 flex-col">
            <header class="border-b border-slate-200 bg-white/90 backdrop-blur">
                <div class="flex flex-col gap-4 px-4 py-4 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                    <div>
                        <p class="text-sm font-medium text-orange-600">
                            Overview
                        </p>
                        <h2 class="text-2xl font-semibold text-slate-900">
                            @yield('title')
                        </h2>
                    </div>

                    <div class="flex items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <div>
                            <div class="text-sm font-medium text-slate-800">
                                {{ auth()->user()->name }}
                            </div>
                            <div class="text-xs text-slate-500">
                                {{ auth()->user()->email }}
                            </div>
                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white transition hover:bg-slate-700">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <div class="mx-auto max-w-7xl space-y-6">
                    @if(session('success'))
                        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>