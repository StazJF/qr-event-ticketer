<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-950">
    <header class="border-b border-zinc-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="{{ route('events.public.index') }}" class="text-lg font-semibold">QR Event Ticketer</a>
            <nav class="flex items-center gap-3 text-sm">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-zinc-700 hover:text-zinc-950">Dashboard</a>
                    <a href="{{ route('admin.events.index') }}" class="text-zinc-700 hover:text-zinc-950">Events</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-md bg-zinc-950 px-3 py-2 font-medium text-white hover:bg-zinc-800">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-md bg-zinc-950 px-3 py-2 font-medium text-white hover:bg-zinc-800">Admin Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8">
        @if (session('status'))
            <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        {{ $slot }}
    </main>
</body>
</html>
