@extends('layouts.admin')

@section('title','Create Post')

@section('content')

<div class="bg-white rounded-lg shadow p-8">

    <form
        action="{{ route('admin.posts.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @include('admin.posts._form')

    </form>

</div>

@endsection