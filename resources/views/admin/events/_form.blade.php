@csrf

<div class="grid gap-5">
    <label class="block">
        <span class="text-sm font-medium">Title</span>
        <input name="title" value="{{ old('title', $event->title ?? '') }}" required class="mt-1 w-full rounded-md border-zinc-300">
        @error('title') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
    </label>

    <label class="block">
        <span class="text-sm font-medium">Description</span>
        <textarea name="description" rows="5" required class="mt-1 w-full rounded-md border-zinc-300">{{ old('description', $event->description ?? '') }}</textarea>
        @error('description') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
    </label>

    <div class="grid gap-5 md:grid-cols-2">
        <label class="block">
            <span class="text-sm font-medium">Location</span>
            <input name="location" value="{{ old('location', $event->location ?? '') }}" required class="mt-1 w-full rounded-md border-zinc-300">
            @error('location') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
        </label>

        <label class="block">
            <span class="text-sm font-medium">Event date</span>
            <input name="event_date" type="datetime-local" value="{{ old('event_date', isset($event) ? $event->event_date?->format('Y-m-d\TH:i') : '') }}" required class="mt-1 w-full rounded-md border-zinc-300">
            @error('event_date') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
        </label>
    </div>

    <div class="grid gap-5 md:grid-cols-2">
        <label class="block">
            <span class="text-sm font-medium">Capacity</span>
            <input name="capacity" type="number" min="1" value="{{ old('capacity', $event->capacity ?? 100) }}" required class="mt-1 w-full rounded-md border-zinc-300">
            @error('capacity') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
        </label>

        <label class="block">
            <span class="text-sm font-medium">Status</span>
            <select name="status" required class="mt-1 w-full rounded-md border-zinc-300">
                @foreach (\App\Enums\EventStatus::cases() as $status)
                    <option value="{{ $status->value }}" @selected(old('status', $event->status ?? 'active') === $status->value)>{{ ucfirst($status->value) }}</option>
                @endforeach
            </select>
            @error('status') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
        </label>
    </div>

    <div class="flex items-center gap-3">
        <button class="rounded-md bg-zinc-950 px-4 py-2 font-medium text-white hover:bg-zinc-800">{{ $button }}</button>
        <a href="{{ route('admin.events.index') }}" class="rounded-md border border-zinc-300 px-4 py-2 font-medium hover:bg-zinc-50">Cancel</a>
    </div>
</div>
