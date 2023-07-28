<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML</title>
    <?php ar_assets('css', 'css/style') ?>
    <style>
        #table {
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto;
        }
        #table tr th{
            text-align: center;
        }

        #table td, #table th{
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        #table tr:nth-child(even){background-color: #f2f2f2;}

        #table tr:hover {background-color: #ddd;}

        #table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>

</head>
<body>
    <header>
        <h1 style="text-align: center;">Header</h1>
    </header>

    <?php echo $__env->yieldContent('content'); ?>

    <footer style="text-align: center;position: absolute;bottom: 0;width: 100%;">
        <h1 style="text-align: center;">Footer</h1>
    </footer>
    <?php ar_assets('js', 'js/app') ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\arash-framework\wp-content\plugins\Wordcool\resources\views/layouts/master.blade.php ENDPATH**/ ?>