<x-layouts.app title="Create Event">
    <div class="mx-auto max-w-3xl rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">Create Event</h1>
        <form method="POST" action="{{ route('admin.events.store') }}" class="mt-6">
            @include('admin.events._form', ['button' => 'Create Event'])
        </form>
    </div>
</x-layouts.app>
