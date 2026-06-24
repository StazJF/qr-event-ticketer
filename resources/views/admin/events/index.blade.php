<x-layouts.app title="Admin Events">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-semibold">Events</h1>
        <a href="{{ route('admin.events.create') }}" class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">New Event</a>
    </div>

    <div class="mt-8 overflow-hidden rounded-lg border border-zinc-200 bg-white">
        @forelse ($events as $event)
            <div class="grid gap-3 border-b border-zinc-100 px-4 py-4 last:border-b-0 lg:grid-cols-[1fr_auto] lg:items-center">
                <div>
                    <a href="{{ route('admin.events.show', $event) }}" class="font-semibold hover:underline">{{ $event->title }}</a>
                    <div class="mt-1 text-sm text-zinc-600">{{ $event->location }} · {{ $event->event_date?->format('M d, Y h:i A') }}</div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.events.edit', $event) }}" class="rounded-md border border-zinc-300 px-3 py-2 text-sm font-medium hover:bg-zinc-50">Edit</a>
                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}">
                        @csrf
                        @method('DELETE')
                        <button class="rounded-md border border-red-200 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-50">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="px-4 py-6 text-zinc-600">No events have been created.</div>
        @endforelse
    </div>

    <div class="mt-5">{{ $events->links() }}</div>
</x-layouts.app>
