<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - Food Blog CMS</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100">

<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between">

        <a href="{{ route('home') }}"
           class="text-3xl font-bold text-orange-600">
            🍽 Food Blog CMS
        </a>

        <a href="{{ route('home') }}"
           class="text-orange-600">
            ← Back Home
        </a>

    </div>
</nav>

<div class="max-w-7xl mx-auto py-10 px-6">

    <h1 class="text-4xl font-bold mb-8">

        Category: {{ $category->name }}

    </h1>

    <div class="grid md:grid-cols-3 gap-8">

        @forelse($posts as $post)

            <div class="bg-white rounded-lg shadow overflow-hidden">

                @if($post->featured_image)

                    <img
                        src="{{ asset('storage/'.$post->featured_image) }}"
                        class="w-full h-56 object-cover">

                @endif

                <div class="p-6">

                    <h2 class="text-2xl font-bold">

                        {{ $post->title }}

                    </h2>

                    <p class="text-gray-600 mt-3">

                        {{ $post->excerpt }}

                    </p>

                    <a
                        href="{{ route('post.show',$post) }}"
                        class="text-orange-600 font-bold mt-4 inline-block">

                        Read More →

                    </a>

                </div>

            </div>

        @empty

            <div class="col-span-3 text-center py-20">

                No posts found.

            </div>

        @endforelse

    </div>

    <div class="mt-10">

        {{ $posts->links() }}

    </div>

</div>

</body>

</html>