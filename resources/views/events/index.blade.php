<x-layouts.app title="Events">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-3xl font-semibold">Upcoming Events</h1>
            <p class="mt-1 text-zinc-600">Register and receive your QR-coded ticket instantly.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($events as $event)
            <article class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <div class="text-sm font-medium text-emerald-700">{{ $event->event_date?->format('M d, Y h:i A') }}</div>
                <h2 class="mt-2 text-xl font-semibold">{{ $event->title }}</h2>
                <p class="mt-2 line-clamp-3 text-sm text-zinc-600">{{ $event->description }}</p>
                <div class="mt-4 text-sm text-zinc-700">{{ $event->location }}</div>
                <a href="{{ route('events.public.show', $event) }}" class="mt-5 inline-flex rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">View Event</a>
            </article>
        @empty
            <div class="rounded-lg border border-zinc-200 bg-white p-8 text-zinc-600">No active events are available.</div>
        @endforelse
    </div>
</x-layouts.app>
