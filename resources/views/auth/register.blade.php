<x-layouts.app title="Create Admin Account">
    <div class="mx-auto max-w-md rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">Create Admin Account</h1>

        <form method="POST" action="{{ route('admin.register.store') }}" class="mt-6 space-y-4">
            @csrf

            <label class="block">
                <span class="text-sm font-medium">Name</span>
                <input name="name" value="{{ old('name') }}" required autofocus class="mt-1 w-full rounded-md border-zinc-300">
                @error('name') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
            </label>

            <label class="block">
                <span class="text-sm font-medium">Email</span>
                <input name="email" type="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-md border-zinc-300">
                @error('email') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
            </label>

            <label class="block">
                <span class="text-sm font-medium">Password</span>
                <input name="password" type="password" required class="mt-1 w-full rounded-md border-zinc-300">
                @error('password') <span class="mt-1 block text-sm text-red-600">{{ $message }}</span> @enderror
            </label>

            <label class="block">
                <span class="text-sm font-medium">Confirm password</span>
                <input name="password_confirmation" type="password" required class="mt-1 w-full rounded-md border-zinc-300">
            </label>

            <button class="w-full rounded-md bg-zinc-950 px-4 py-2 font-medium text-white hover:bg-zinc-800">Create Account</button>
        </form>

        <a href="{{ route('login') }}" class="mt-5 block text-center text-sm font-medium text-zinc-700 hover:text-zinc-950">Back to login</a>
    </div>
</x-layouts.app>
