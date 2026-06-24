<x-layouts.app title="Ticket">
    <div class="mx-auto max-w-xl rounded-lg border border-zinc-200 bg-white p-6 text-center shadow-sm">
        <div class="text-sm font-medium text-emerald-700">{{ $ticket->event->event_date?->format('M d, Y h:i A') }}</div>
        <h1 class="mt-2 text-2xl font-semibold">{{ $ticket->event->title }}</h1>
        <p class="mt-1 text-zinc-600">{{ $ticket->event->location }}</p>

        <img src="{{ Storage::disk('public')->url($ticket->qr_code_path) }}" alt="QR code for {{ $ticket->ticket_code }}" class="mx-auto mt-6 h-64 w-64 rounded-md border border-zinc-200 p-3">

        <dl class="mt-6 grid gap-3 text-left">
            <div class="flex justify-between border-b border-zinc-100 pb-3">
                <dt class="text-zinc-500">Attendee</dt>
                <dd class="font-medium">{{ $ticket->full_name }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-zinc-500">Ticket Code</dt>
                <dd class="font-mono font-semibold">{{ $ticket->ticket_code }}</dd>
            </div>
        </dl>

        <a href="{{ route('tickets.download', $ticket->ticket_code) }}" class="mt-6 inline-flex rounded-md bg-zinc-950 px-4 py-2 font-medium text-white hover:bg-zinc-800">Download QR</a>
    </div>
</x-layouts.app>
