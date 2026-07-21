@extends('layouts.guest')

@section('title', 'Food Blog CMS')

@section('content')
<section class="bg-gradient-to-r from-orange-500 to-rose-500 text-white">
    <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-orange-100">Food inspiration</p>
                <h1 class="mt-6 text-5xl font-extrabold tracking-tight sm:text-6xl">
                    Discover recipes from talented composers.
                </h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-orange-100">
                    Browse featured dishes, explore tasty categories, and read the freshest meals created by our community.
                </p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-white px-8 py-3 text-sm font-semibold text-slate-950 shadow-xl shadow-orange-500/20 transition hover:bg-slate-100">
                        Join the community
                    </a>
                    <a href="#latest" class="inline-flex items-center justify-center rounded-full border border-white/30 px-8 py-3 text-sm font-semibold text-white/90 transition hover:border-white hover:text-white">
                        Browse articles
                    </a>
                </div>
            </div>
            <div class="rounded-[2rem] border border-white/20 bg-white/10 p-8 shadow-2xl shadow-slate-950/10 backdrop-blur-xl">
                <div class="space-y-6">
                    <div class="rounded-3xl bg-white p-6 text-slate-950 shadow-sm">
                        <p class="text-xs uppercase tracking-[0.3em] text-orange-600">Top category</p>
                        <h2 class="mt-3 text-3xl font-semibold">Dinner</h2>
                        <p class="mt-4 text-sm text-slate-600">Quick, delicious meals for busy weeknights.</p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach($categories->take(4) as $category)
                            <a href="{{ route('category.show', $category) }}" class="rounded-3xl bg-white/90 px-5 py-4 text-sm font-semibold text-slate-950 transition hover:bg-orange-500 hover:text-white">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="bg-slate-50 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <form action="{{ route('home') }}" method="GET" class="rounded-3xl border border-slate-200 bg-white px-6 py-5 shadow-sm sm:px-8">
            <label for="search" class="text-sm font-medium text-slate-700">Search recipes</label>
            <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-center">
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search recipes, categories, or composers" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-200" />
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-orange-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="bg-slate-50 pb-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <div>
                <h2 class="text-3xl font-semibold text-slate-950">Featured Article</h2>
                <p class="mt-2 text-sm text-slate-600">Fresh ideas and crowd favorites from our latest recipes.</p>
            </div>
            @if($featured)
                <a href="{{ route('post.show', $featured) }}" class="text-sm font-semibold text-orange-600 transition hover:text-orange-700">View featured →</a>
            @endif
        </div>

        @if($featured)
            <div class="mt-8 overflow-hidden rounded-[2rem] bg-white shadow-xl shadow-slate-900/5">
                <div class="lg:grid lg:grid-cols-[0.8fr_1fr] lg:items-stretch">
                    @if($featured->featured_image)
                        <img src="{{ asset('storage/'.$featured->featured_image) }}" alt="{{ $featured->title }}" class="h-96 w-full object-cover lg:h-full" />
                    @endif
                    <div class="p-8 sm:p-10 lg:p-12">
                        <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-sm font-semibold text-orange-700">{{ $featured->category->name }}</span>
                        <h3 class="mt-6 text-4xl font-bold text-slate-950">{{ $featured->title }}</h3>
                        <p class="mt-5 text-slate-600">{{ $featured->excerpt }}</p>
                        <div class="mt-8 flex flex-wrap items-center gap-3 text-sm text-slate-500">
                            <span>By {{ $featured->user->name }}</span>
                            <span>•</span>
                            <span>{{ optional($featured->published_at)->format('M d, Y') }}</span>
                        </div>
                        <a href="{{ route('post.show',$featured) }}" class="mt-8 inline-flex rounded-full bg-orange-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">Read the article</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="bg-slate-50 pb-20" id="latest">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-3xl font-semibold text-slate-950">Latest Articles</h2>
                <p class="mt-2 text-sm text-slate-600">Catch the newest posts from our community.</p>
            </div>
        </div>
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse($posts as $post)
                <article class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="h-64 w-full object-cover" />
                    @endif
                    <div class="p-6">
                        <span class="text-sm font-semibold uppercase tracking-[0.2em] text-orange-500">{{ $post->category->name }}</span>
                        <h3 class="mt-4 text-2xl font-semibold text-slate-950">{{ $post->title }}</h3>
                        <p class="mt-4 text-sm leading-6 text-slate-600">{{ $post->excerpt }}</p>
                        <div class="mt-6 flex items-center justify-between text-sm text-slate-500">
                            <span>{{ $post->user->name }}</span>
                            <span>{{ optional($post->published_at)->format('M d, Y') }}</span>
                        </div>
                        <a href="{{ route('post.show',$post) }}" class="mt-6 inline-flex text-sm font-semibold text-orange-600 transition hover:text-orange-700">Read More →</a>
                    </div>
                </article>
            @empty
                <div class="col-span-3 rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center text-slate-500">
                    No articles available.
                </div>
            @endforelse
        </div>
        <div class="mt-10">{{ $posts->links() }}</div>
    </div>
</div>
@endsection