<x-app-layout>

<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-8">

        Edit Category

    </h1>

    <form
        action="{{ route('admin.categories.update',$category) }}"
        method="POST"
        class="bg-white shadow rounded-lg p-8">

        @csrf

        @method('PUT')

        <div>

            <label class="font-semibold">

                Category Name

            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name',$category->name) }}"
                class="w-full mt-2 border rounded p-3">

            @error('name')

                <p class="text-red-600 mt-2">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <div class="mt-8">

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded">

                Update Category

            </button>

        </div>

    </form>

</div>

</x-app-layout>