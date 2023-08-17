<h2> لیست <?php echo e($name); ?></h2>
<br><br>

<table class="wp-list-table widefat fixed striped table-view-list">
    <thead>
        <tr>
            <td>#</td>
            <td>نام</td>
            <td>شماره</td>
            <td>مدریت</td>
        </tr>
    </thead>

    <tbody>
        <?php $__currentLoopData = $sample; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($key + 1); ?></td>
                <td><?php echo e($value->name); ?></td>
                <td><?php echo e($value->phone); ?></td>
                <td>
                    <a href="<?php echo e(add_query_arg(['action' => 'edit', 'id' => $value->id])); ?>">ویرایش</a> |
                    <a href="<?php echo e(add_query_arg(['action' => 'delete', 'id' => $value->id])); ?>">حذف</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\arash-framework\wp-content\plugins\Wordcool\resources\views/test.blade.php ENDPATH**/ ?>