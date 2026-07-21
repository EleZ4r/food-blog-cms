@extends('layouts.composer')

@section('title','My Posts')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">

        My Posts

    </h1>

    <a href="{{ route('composer.posts.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

        + New Post

    </a>

</div>

<div class="bg-white rounded-lg shadow overflow-hidden">

<table class="min-w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-4">Title</th>
<th>Status</th>
<th>Date</th>
<th>Actions</th>

</tr>

</thead>

<tbody>

@forelse($posts as $post)

<tr class="border-b">

<td class="p-4">

{{ $post->title }}

</td>

<td>

@if($post->status=="draft")

<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

Draft

</span>

@elseif($post->status=="pending")

<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">

Pending

</span>

@elseif($post->status=="published")

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

Published

</span>

@else

<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

Rejected

</span>

@endif

</td>

<td>

{{ $post->created_at->format('M d, Y') }}

</td>

<td>

@if($post->status=='draft')

<a
href="{{ route('composer.posts.edit',$post) }}"
class="text-blue-600">

Edit

</a>

<form
action="{{ route('composer.posts.submit',$post) }}"
method="POST"
class="inline">

@csrf
@method('PUT')

<button
class="text-green-600 ml-4">

Submit

</button>

</form>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="4" class="text-center p-8">

No posts yet.

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