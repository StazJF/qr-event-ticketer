<x-layouts.app :title="$event->title">
    <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
        <section>
            <div class="text-sm font-medium text-emerald-700">{{ $event->event_date?->format('M d, Y h:i A') }}</div>
            <h1 class="mt-2 text-4xl font-semibold">{{ $event->title }}</h1>
            <p class="mt-4 whitespace-pre-line text-zinc-700">{{ $event->description }}</p>
            <dl class="mt-8 grid gap-4 sm:grid-cols-3">
                <div class="rounded-lg border border-zinc-200 bg-white p-4">
                    <dt class="text-sm text-zinc-500">Location</dt>
                    <dd class="mt-1 font-medium">{{ $event->location }}</dd>
                </div>
                <div class="rounded-lg border border-zinc-200 bg-white p-4">
                    <dt class="text-sm text-zinc-500">Capacity</dt>
                    <dd class="mt-1 font-medium">{{ $attendeeCount }} / {{ $event->capacity }}</dd>
                </div>
                <div class="rounded-lg border border-zinc-200 bg-white p-4">
                    <dt class="text-sm text-zinc-500">Status</dt>
                    <dd class="mt-1 font-medium capitalize">{{ $event->status }}</dd>
                </div>
            </dl>
        </section>

        <aside class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold">Register</h2>
            <form method="POST" action="{{ route('events.register', $event) }}" class="mt-5 space-y-4">
                @csrf
                <label class="block">
                    <span class="text-sm font-medium">Full name</span>
                    <input name="full_name" value="{{ old('full_name') }}" required class="mt-1 w-full rounded-md border-zinc-300">
                    @error('full_name') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="block">
                    <span class="text-sm font-medium">Email</span>
                    <input name="email" type="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-md border-zinc-300">
                    @error('email') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <label class="block">
                    <span class="text-sm font-medium">Phone</span>
                    <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-md border-zinc-300">
                    @error('phone') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
                </label>
                <button class="w-full rounded-md bg-zinc-950 px-4 py-2 font-medium text-white hover:bg-zinc-800">Get Ticket</button>
            </form>
        </aside>
    </div>
</x-layouts.app>
