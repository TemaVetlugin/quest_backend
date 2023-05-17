<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script>
        <?php if(session()->has('token')): ?>
            var token = "<?php echo e(session('token')); ?>"; // Получаем строку из переменной PHP
            localStorage.setItem('access_token', token);
            <?php endif; ?>
        // Добавляем строку в localStorage
    </script>
    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
    <!-- Chatra {literal} -->












    <!-- /Chatra {/literal} -->
    <title>JWT SPA</title>
</head>
<body class="p-5">

<div id="app">
    <?php echo $__env->yieldContent('content'); ?>
</div>
</body>
</html>
<?php /**PATH /var/www/html/quest/resources/views/layouts/main.blade.php ENDPATH**/ ?>