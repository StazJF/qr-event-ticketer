<x-layouts.app title="Edit Event">
    <div class="mx-auto max-w-3xl rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">Edit Event</h1>
        <form method="POST" action="{{ route('admin.events.update', $event) }}" class="mt-6">
            @method('PUT')
            @include('admin.events._form', ['button' => 'Save Changes'])
        </form>
    </div>
</x-layouts.app>
