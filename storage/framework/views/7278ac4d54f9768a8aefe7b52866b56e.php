<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Ticket']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Ticket']); ?>
    <div class="mx-auto max-w-xl rounded-lg border border-zinc-200 bg-white p-6 text-center shadow-sm">
        <div class="text-sm font-medium text-emerald-700"><?php echo e($ticket->event->event_date?->format('M d, Y h:i A')); ?></div>
        <h1 class="mt-2 text-2xl font-semibold"><?php echo e($ticket->event->title); ?></h1>
        <p class="mt-1 text-zinc-600"><?php echo e($ticket->event->location); ?></p>

        <img src="<?php echo e(Storage::disk('public')->url($ticket->qr_code_path)); ?>" alt="QR code for <?php echo e($ticket->ticket_code); ?>" class="mx-auto mt-6 h-64 w-64 rounded-md border border-zinc-200 p-3">

        <dl class="mt-6 grid gap-3 text-left">
            <div class="flex justify-between border-b border-zinc-100 pb-3">
                <dt class="text-zinc-500">Attendee</dt>
                <dd class="font-medium"><?php echo e($ticket->full_name); ?></dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-zinc-500">Ticket Code</dt>
                <dd class="font-mono font-semibold"><?php echo e($ticket->ticket_code); ?></dd>
            </div>
        </dl>

        <a href="<?php echo e(route('tickets.download', $ticket->ticket_code)); ?>" class="mt-6 inline-flex rounded-md bg-zinc-950 px-4 py-2 font-medium text-white hover:bg-zinc-800">Download QR</a>
    </div>
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
<?php /**PATH D:\PROG TRIALS\qr-event-ticketer\resources\views/tickets/show.blade.php ENDPATH**/ ?>