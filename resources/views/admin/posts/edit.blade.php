@extends('layouts.admin')

@section('title','Edit Post')

@section('content')

<div class="bg-white rounded-lg shadow p-8">

    <form
        action="{{ route('admin.posts.update',$post) }}"
        method="POST"
        enctype="multipart/form-data">

        @method('PUT')

        @include('admin.posts._form')

    </form>

</div>

@endsection