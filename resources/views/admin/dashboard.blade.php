@extends('layouts.admin')

@section('title','Dashboard')

@section('content')
<div class="space-y-6">
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Users</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $users }}</p>
                </div>
                <div class="rounded-2xl bg-blue-100 p-3 text-blue-600">👥</div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Categories</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $categories }}</p>
                </div>
                <div class="rounded-2xl bg-violet-100 p-3 text-violet-600">☰</div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Posts</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $posts }}</p>
                </div>
                <div class="rounded-2xl bg-orange-100 p-3 text-orange-600">✎</div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Published</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $published }}</p>
                </div>
                <div class="rounded-2xl bg-emerald-100 p-3 text-emerald-600">✓</div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Pending</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $pending }}</p>
                </div>
                <div class="rounded-2xl bg-amber-100 p-3 text-amber-600">⏳</div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Drafts</p>
                    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $drafts }}</p>
                </div>
                <div class="rounded-2xl bg-slate-100 p-3 text-slate-600">📝</div>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Recent Posts</h2>
                <p class="text-sm text-slate-500">Latest content updates at a glance.</p>
            </div>
            <a href="{{ route('admin.posts.index') }}" class="text-sm font-medium text-orange-600 hover:text-orange-700">
                View all posts
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Created</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($recentPosts as $post)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $post->title }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $post->user->name }}</td>
                            <td class="px-6 py-4 text-sm">
                                @php
                                    $statusClasses = [
                                        'published' => 'bg-emerald-100 text-emerald-700',
                                        'pending' => 'bg-amber-100 text-amber-700',
                                        'draft' => 'bg-slate-100 text-slate-700',
                                    ];
                                @endphp
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClasses[$post->status] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $post->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-slate-500">
                                No posts have been created yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection