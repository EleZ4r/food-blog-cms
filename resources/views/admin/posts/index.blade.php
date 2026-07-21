@extends('layouts.admin')

@section('title', 'Posts')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Manage Posts
    </h1>

    <a href="{{ route('admin.posts.create') }}"
        class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">

        + New Post

    </a>

</div>

<div class="bg-white rounded-lg shadow overflow-hidden">

    <table class="min-w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="p-4">Image</th>

                <th>Title</th>

                <th>Category</th>

                <th>Author</th>

                <th>Status</th>

                <th>Date</th>

                <th width="320">Actions</th>

            </tr>

        </thead>

        <tbody>

            @forelse($posts as $post)

                <tr class="border-b">

                    <td class="p-4">

                        @if($post->featured_image)

                            <img
                                src="{{ asset('storage/'.$post->featured_image) }}"
                                class="w-20 h-16 object-cover rounded">

                        @else

                            <div class="w-20 h-16 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-500">

                                No Image

                            </div>

                        @endif

                    </td>

                    <td>

                        <strong>{{ $post->title }}</strong>

                    </td>

                    <td>

                        {{ $post->category->name ?? '-' }}

                    </td>

                    <td>

                        {{ $post->user->name ?? '-' }}

                    </td>

                    <td>

                        @switch($post->status)

                            @case('draft')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                                    Draft
                                </span>

                                @break

                            @case('pending')

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                                    Pending
                                </span>

                                @break

                            @case('published')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                    Published
                                </span>

                                @break

                            @case('rejected')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                                    Rejected
                                </span>

                                @break

                        @endswitch

                    </td>

                    <td>

                        {{ $post->created_at->format('M d, Y') }}

                    </td>

                    <td>

                        @if($post->status == 'pending')

                            <form
                                action="{{ route('admin.posts.approve', $post) }}"
                                method="POST"
                                class="inline">

                                @csrf
                                @method('PUT')

                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">

                                    Approve

                                </button>

                            </form>

                            <form
                                action="{{ route('admin.posts.reject', $post) }}"
                                method="POST"
                                class="inline">

                                @csrf
                                @method('PUT')

                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded ml-2">

                                    Reject

                                </button>

                            </form>

                        @endif

                        <a
                            href="{{ route('admin.posts.edit', $post) }}"
                            class="text-blue-600 font-semibold ml-3">

                            Edit

                        </a>

                        <form
                            action="{{ route('admin.posts.destroy', $post) }}"
                            method="POST"
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete this post?')"
                                class="text-red-600 font-semibold ml-3">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center p-8 text-gray-500">

                        No posts found.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

<div class="mt-6">

    {{ $posts->links() }}

</div>

@endsection