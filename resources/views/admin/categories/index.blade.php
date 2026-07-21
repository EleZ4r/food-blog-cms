@extends('layouts.admin')

@section('title','Categories')

@section('content')

<div class="flex justify-between mb-6">

    <h1 class="text-3xl font-bold">

        Categories

    </h1>

    <a href="{{ route('admin.categories.create') }}"
        class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded">

        Add Category

    </a>

</div>

<div class="bg-white rounded-lg shadow">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-4 text-left">Name</th>

<th>Slug</th>

<th>Actions</th>

</tr>

</thead>

<tbody>

@forelse($categories as $category)

<tr class="border-b">

<td class="p-4">

{{ $category->name }}

</td>

<td>

{{ $category->slug }}

</td>

<td class="text-center">

<a href="{{ route('admin.categories.edit',$category) }}"
class="text-blue-600">

Edit

</a>

<form
action="{{ route('admin.categories.destroy',$category) }}"
method="POST"
class="inline">

@csrf

@method('DELETE')

<button
onclick="return confirm('Delete this category?')"
class="text-red-600 ml-4">

Delete

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="3"
class="text-center p-6">

No categories.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $categories->links() }}

</div>

@endsection