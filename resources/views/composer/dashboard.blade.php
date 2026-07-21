@extends('layouts.composer')

@section('title','Composer Dashboard')

@section('content')
<div class="space-y-6">
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Total Posts</p>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ $totalPosts }}</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Drafts</p>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ $drafts }}</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Pending</p>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ $pending }}</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Published</p>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ $published }}</p>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Rejected</p>
            <p class="mt-4 text-3xl font-bold text-slate-900">{{ $rejected }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">My Recent Posts</h2>
                <p class="mt-1 text-sm text-slate-500">Track the latest drafts and submissions.</p>
            </div>
            <a href="{{ route('composer.posts.index') }}" class="text-sm font-semibold text-cyan-600 transition hover:text-cyan-700">View all posts</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Title</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Created</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($recentPosts as $post)
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $post->title }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ ucfirst($post->status) }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $post->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-sm text-slate-500">No posts yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
