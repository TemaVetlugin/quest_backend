<?php $__env->startSection('content'); ?>
<div id="message" data-message="<?php echo e(session('message')); ?>">
    <Index></Index>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/quest/resources/views/main/index.blade.php ENDPATH**/ ?>