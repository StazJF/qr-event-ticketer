<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? config('app.name')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-950">
    <header class="border-b border-zinc-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="<?php echo e(route('events.public.index')); ?>" class="text-lg font-semibold">QR Event Ticketer</a>
            <nav class="flex items-center gap-3 text-sm">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-zinc-700 hover:text-zinc-950">Dashboard</a>
                    <a href="<?php echo e(route('admin.events.index')); ?>" class="text-zinc-700 hover:text-zinc-950">Events</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="rounded-md bg-zinc-950 px-3 py-2 font-medium text-white hover:bg-zinc-800">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="rounded-md bg-zinc-950 px-3 py-2 font-medium text-white hover:bg-zinc-800">Admin Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8">
        <?php if(session('status')): ?>
            <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <?php echo e($slot); ?>

    </main>
</body>
</html>
<?php /**PATH D:\PROG TRIALS\qr-event-ticketer\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>