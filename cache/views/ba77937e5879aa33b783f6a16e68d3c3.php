<?php $__env->startSection('content'); ?>
<p style="text-align: center;">this is index page</p>

<table id="table">
    <tr>
        <th>نام</th>
        <th>موبایل</th>
    </tr>
    <tbody>
    <?php $__currentLoopData = $samples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?= $value->name ?></td>
            <td><?= $value->phone ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php
    errors();
?>

<?php if(getSession('success')): ?>
    <h3><?php echo e(getSession('success')); ?> </h3>
<?php endif; ?>

<form action="<?php echo e(route('/save')); ?> " name="save" method="post">

    <label for="name">First name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="name">phone:</label><br>
    <input type="text" id="phone" name="phone"><br>
    <input type="submit" value="Submit">

</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\arash-framework\wp-content\plugins\Wordcool\resources\views/index.blade.php ENDPATH**/ ?>