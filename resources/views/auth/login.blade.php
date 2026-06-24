<x-layouts.app title="Admin Login">
    <div class="mx-auto max-w-md rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">Admin Login</h1>

        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
            @csrf

            <label class="block">
                <span class="text-sm font-medium">Email</span>
                <input name="email" type="email" value="{{ old('email') }}" required autofocus class="mt-1 w-full rounded-md border-zinc-300">
                @error('email') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
            </label>

            <label class="block">
                <span class="text-sm font-medium">Password</span>
                <input name="password" type="password" required class="mt-1 w-full rounded-md border-zinc-300">
                @error('password') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
            </label>

            <label class="flex items-center gap-2 text-sm">
                <input name="remember" type="checkbox" value="1" class="rounded border-zinc-300">
                Remember this device
            </label>

            <button class="w-full rounded-md bg-zinc-950 px-4 py-2 font-medium text-white hover:bg-zinc-800">Login</button>
        </form>

        {{-- <div class="mt-6 border-t border-zinc-200 pt-5 text-center">
            <p class="text-sm text-zinc-600">Need an admin account?</p>
            <a href="{{ route('admin.register.create') }}" class="mt-3 inline-flex w-full justify-center rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium hover:bg-zinc-50">
                Create Admin Account
            </a>
        </div> --}}
    </div>
</x-layouts.app>
