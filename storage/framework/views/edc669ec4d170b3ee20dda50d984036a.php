<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Admin Dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Admin Dashboard']); ?>
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-semibold">Dashboard</h1>
        <a href="<?php echo e(route('admin.events.create')); ?>" class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800">New Event</a>
    </div>

    <dl class="mt-8 grid gap-4 sm:grid-cols-3">
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <dt class="text-sm text-zinc-500">Total Events</dt>
            <dd class="mt-2 text-3xl font-semibold"><?php echo e($total_events); ?></dd>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <dt class="text-sm text-zinc-500">Total Attendees</dt>
            <dd class="mt-2 text-3xl font-semibold"><?php echo e($total_attendees); ?></dd>
        </div>
        <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <dt class="text-sm text-zinc-500">Total Check-ins</dt>
            <dd class="mt-2 text-3xl font-semibold"><?php echo e($total_check_ins); ?></dd>
        </div>
    </dl>

    <section class="mt-10">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">Upcoming Events</h2>
            <a href="<?php echo e(route('admin.checkin.create')); ?>" class="text-sm font-medium text-zinc-700 hover:text-zinc-950">Check in attendees</a>
        </div>
        <div class="mt-4 overflow-hidden rounded-lg border border-zinc-200 bg-white">
            <?php $__empty_1 = true; $__currentLoopData = $upcoming_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('admin.events.show', $event)); ?>" class="grid gap-2 border-b border-zinc-100 px-4 py-4 last:border-b-0 sm:grid-cols-[1fr_auto]">
                    <span class="font-medium"><?php echo e($event->title); ?></span>
                    <span class="text-sm text-zinc-600"><?php echo e($event->event_date?->format('M d, Y h:i A')); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="px-4 py-6 text-zinc-600">No upcoming events.</div>
            <?php endif; ?>
        </div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH D:\PROG TRIALS\qr-event-ticketer\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>