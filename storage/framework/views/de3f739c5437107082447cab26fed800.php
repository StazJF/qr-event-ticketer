<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => $event->title]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($event->title)]); ?>
    <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
        <section>
            <div class="text-sm font-medium text-emerald-700"><?php echo e($event->event_date?->format('M d, Y h:i A')); ?></div>
            <h1 class="mt-2 text-4xl font-semibold"><?php echo e($event->title); ?></h1>
            <p class="mt-4 whitespace-pre-line text-zinc-700"><?php echo e($event->description); ?></p>
            <dl class="mt-8 grid gap-4 sm:grid-cols-3">
                <div class="rounded-lg border border-zinc-200 bg-white p-4">
                    <dt class="text-sm text-zinc-500">Location</dt>
                    <dd class="mt-1 font-medium"><?php echo e($event->location); ?></dd>
                </div>
                <div class="rounded-lg border border-zinc-200 bg-white p-4">
                    <dt class="text-sm text-zinc-500">Capacity</dt>
                    <dd class="mt-1 font-medium"><?php echo e($attendeeCount); ?> / <?php echo e($event->capacity); ?></dd>
                </div>
                <div class="rounded-lg border border-zinc-200 bg-white p-4">
                    <dt class="text-sm text-zinc-500">Status</dt>
                    <dd class="mt-1 font-medium capitalize"><?php echo e($event->status); ?></dd>
                </div>
            </dl>
        </section>

        <aside class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold">Register</h2>
            <form method="POST" action="<?php echo e(route('events.register', $event)); ?>" class="mt-5 space-y-4">
                <?php echo csrf_field(); ?>
                <label class="block">
                    <span class="text-sm font-medium">Full name</span>
                    <input name="full_name" value="<?php echo e(old('full_name')); ?>" required class="mt-1 w-full rounded-md border-zinc-300">
                    <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="mt-1 block text-sm text-red-600"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </label>
                <label class="block">
                    <span class="text-sm font-medium">Email</span>
                    <input name="email" type="email" value="<?php echo e(old('email')); ?>" required class="mt-1 w-full rounded-md border-zinc-300">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="mt-1 block text-sm text-red-600"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </label>
                <label class="block">
                    <span class="text-sm font-medium">Phone</span>
                    <input name="phone" value="<?php echo e(old('phone')); ?>" class="mt-1 w-full rounded-md border-zinc-300">
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="mt-1 block text-sm text-red-600"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </label>
                <button class="w-full rounded-md bg-zinc-950 px-4 py-2 font-medium text-white hover:bg-zinc-800">Get Ticket</button>
            </form>
        </aside>
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
<?php /**PATH D:\PROG TRIALS\qr-event-ticketer\resources\views/events/show.blade.php ENDPATH**/ ?>