<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold">
            Composer Dashboard
        </h1>

        <p class="mt-4">
            Welcome, {{ auth()->user()->name }}
        </p>
    </div>
</x-app-layout>