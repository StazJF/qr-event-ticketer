<x-layouts.app title="Admin Dashboard">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-semibold">Dashboard</h1>
        <a href="{{ route('admin.events.create') }}" class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">New Event</a>
    </div>

    <dl class="mt-8 grid gap-4 sm:grid-cols-3">
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <dt class="text-sm text-zinc-500">Total Events</dt>
            <dd class="mt-2 text-3xl font-semibold">{{ $total_events }}</dd>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <dt class="text-sm text-zinc-500">Total Attendees</dt>
            <dd class="mt-2 text-3xl font-semibold">{{ $total_attendees }}</dd>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <dt class="text-sm text-zinc-500">Total Check-ins</dt>
            <dd class="mt-2 text-3xl font-semibold">{{ $total_check_ins }}</dd>
        </div>
    </dl>

    <section class="mt-10">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">Upcoming Events</h2>
            <a href="{{ route('admin.checkin.create') }}" class="text-sm font-medium text-zinc-700 hover:text-zinc-950">Check in attendees</a>
        </div>
        <div class="mt-4 overflow-hidden rounded-lg border border-zinc-200 bg-white">
            @forelse ($upcoming_events as $event)
                <a href="{{ route('admin.events.show', $event) }}" class="grid gap-2 border-b border-zinc-100 px-4 py-4 last:border-b-0 sm:grid-cols-[1fr_auto]">
                    <span class="font-medium">{{ $event->title }}</span>
                    <span class="text-sm text-zinc-600">{{ $event->event_date?->format('M d, Y h:i A') }}</span>
                </a>
            @empty
                <div class="px-4 py-6 text-zinc-600">No upcoming events.</div>
            @endforelse
        </div>
    </section>
</x-layouts.app>
