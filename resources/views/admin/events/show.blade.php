<x-layouts.app :title="$event->title">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <div class="text-sm font-medium uppercase tracking-wide text-emerald-700">{{ $event->status }}</div>
            <h1 class="mt-1 text-3xl font-semibold">{{ $event->title }}</h1>
            <p class="mt-2 text-zinc-600">{{ $event->location }} · {{ $event->event_date?->format('M d, Y h:i A') }}</p>
        </div>
        <a href="{{ route('admin.events.edit', $event) }}" class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">Edit</a>
    </div>

    <dl class="mt-8 grid gap-4 sm:grid-cols-2">
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <dt class="text-sm text-zinc-500">Attendees</dt>
            <dd class="mt-2 text-3xl font-semibold">{{ $attendeeCount }}</dd>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <dt class="text-sm text-zinc-500">Capacity</dt>
            <dd class="mt-2 text-3xl font-semibold">{{ $event->capacity }}</dd>
        </div>
    </dl>

    <section class="mt-8 rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-semibold">Description</h2>
        <p class="mt-3 whitespace-pre-line text-zinc-700">{{ $event->description }}</p>
    </section>
</x-layouts.app>
