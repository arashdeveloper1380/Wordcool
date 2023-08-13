<?php $__env->startSection('content'); ?>
    <p style="text-align: center;">this is index blade page</p>

    <form action="<?php echo e(route('/save')); ?>" name="save" method="POST">
        <?php csrf() ?>
        <label for="name">First name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="name">phone:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <input type="submit" value="Submit">

    </form>
    <br><br>

    <table id="table">
        <tr>
            <th>نام</th>
            <th>موبایل</th>
            <th>عملیات</th>
        </tr>
        <tbody>
            <?php $__currentLoopData = $samples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($value->name); ?></td>
                    <td><?php echo e($value->phone); ?></td>
                    <td>
                        <a href="<?php echo e(routeWithParam('/delete', $value->id)); ?>">حذف</a>
                    </td>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\arash-framework\wp-content\plugins\Wordcool\resources\views/index.blade.php ENDPATH**/ ?>