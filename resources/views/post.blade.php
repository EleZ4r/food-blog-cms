@extends('layouts.guest')

@section('title', $post->title)

@section('content')
<div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
    <article class="space-y-10">
        <div class="overflow-hidden rounded-[2rem] bg-white shadow-xl shadow-slate-900/5">
            @if($post->featured_image)
                <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="h-96 w-full object-cover" />
            @endif
            <div class="px-6 py-8 sm:px-10">
                <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500">
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2">👤 {{ $post->user->name }}</span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2">📂 {{ $post->category->name }}</span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2">📅 {{ optional($post->published_at)->format('F d, Y') }}</span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2">👁 {{ number_format($post->views) }} Views</span>
                </div>
                <h1 class="mt-8 text-5xl font-bold text-slate-950">{{ $post->title }}</h1>
                @if($post->excerpt)
                    <p class="mt-6 max-w-3xl text-xl leading-8 text-slate-600 italic">{{ $post->excerpt }}</p>
                @endif
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1fr_320px]">
            <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
                <div class="prose max-w-none text-slate-700">
                    {!! $post->content !!}
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">Reactions</h2>
                    <p class="mt-3 text-sm text-slate-600">Engage with the post and support the composer.</p>
                    @auth
                        <form action="{{ route('likes.toggle', $post) }}" method="POST" class="mt-6">
                            @csrf
                            <button class="w-full rounded-2xl bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700">❤️ Like ({{ $post->likes->count() }})</button>
                        </form>
                    @else
                        <div class="mt-6 rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">❤️ {{ $post->likes->count() }} Likes</div>
                    @endauth
                </div>

                <div class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h2 class="text-lg font-semibold text-slate-900">Share this article</h2>
                    <div class="mt-4 grid gap-3">
                        <button type="button" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Copy link</button>
                        <button type="button" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Share on Twitter</button>
                    </div>
                </div>
            </aside>
        </div>

        <section class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-3xl font-semibold text-slate-950">Comments</h2>
            @auth
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    <textarea name="comment" rows="4" class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-900 outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-100" placeholder="Write your comment..." required></textarea>
                    <button class="rounded-3xl bg-orange-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">Post Comment</button>
                </form>
            @else
                <div class="mt-6 rounded-3xl bg-amber-50 p-6 text-sm text-amber-800">Please <a href="{{ route('login') }}" class="font-semibold text-orange-600">login</a> to leave a comment.</div>
            @endauth
            <div class="mt-10 space-y-5">
                @forelse($post->comments as $comment)
                    <div class="rounded-3xl bg-slate-50 p-6">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <p class="font-semibold text-slate-900">{{ $comment->user->name }}</p>
                            <span class="text-sm text-slate-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-4 text-slate-700">{{ $comment->comment }}</p>
                    </div>
                @empty
                    <div class="rounded-3xl bg-slate-50 p-6 text-center text-slate-500">No comments yet.</div>
                @endforelse
            </div>
        </section>

        <section class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-2xl font-semibold text-slate-950">Related Posts</h2>
            <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($related as $item)
                    <article class="rounded-3xl border border-slate-200 p-6 transition hover:shadow-lg">
                        <h3 class="text-xl font-semibold text-slate-950">{{ $item->title }}</h3>
                        <a href="{{ route('post.show', $item) }}" class="mt-4 inline-flex text-sm font-semibold text-orange-600 hover:text-orange-700">Read More →</a>
                    </article>
                @empty
                    <p class="text-slate-600">No related posts.</p>
                @endforelse
            </div>
        </section>
    </article>
</div>
@endsection
