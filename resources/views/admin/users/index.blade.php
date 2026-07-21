@extends('layouts.admin')

@section('title','Users')

@section('content')

<div class="bg-white rounded-lg shadow">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-4 text-left">Name</th>

<th>Email</th>

<th>Role</th>

<th>Actions</th>

</tr>

</thead>

<tbody>

@foreach($users as $user)

<tr class="border-b">

<td class="p-4">

{{ $user->name }}

</td>

<td>

{{ $user->email }}

</td>

<td>

<form
action="{{ route('admin.users.update',$user) }}"
method="POST">

@csrf
@method('PUT')

<select
name="role"
onchange="this.form.submit()"
class="border rounded p-2">

@foreach($roles as $role)

<option
value="{{ $role->name }}"
{{ $user->hasRole($role->name) ? 'selected' : '' }}>

{{ ucfirst($role->name) }}

</option>

@endforeach

</select>

</form>

</td>

<td>

@if(auth()->id() != $user->id)

<form
action="{{ route('admin.users.destroy',$user) }}"
method="POST">

@csrf

@method('DELETE')

<button
onclick="return confirm('Delete this user?')"
class="text-red-600">

Delete

</button>

</form>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="mt-6">

{{ $users->links() }}

</div>

@endsection