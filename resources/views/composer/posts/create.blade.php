@extends('layouts.composer')

@section('title', 'Create Post')

@section('content')

    @include('composer.posts._form', [
        'action' => route('composer.posts.store'),
        'method' => 'POST',
        'post' => null,
    ])

@endsection