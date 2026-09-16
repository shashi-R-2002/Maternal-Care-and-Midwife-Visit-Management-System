<!DOCTYPE html>
<html lang="en">
<head>

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mother.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin-midwives.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin-reports.css')); ?>">

</head>

<body>

<?php echo $__env->yieldContent('content'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo e(asset('js/admin.js')); ?>"></script>
<script src="<?php echo e(asset('js/mother.js')); ?>"></script>
<script src="<?php echo e(asset('js/admin-midwives.js')); ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script src="<?php echo e(asset('js/admin-reports.js')); ?>"></script>

</body>
</html><?php /**PATH C:\xampp\htdocs\maternal-care-system\resources\views/layouts/admin.blade.php ENDPATH**/ ?>