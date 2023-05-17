<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script>
        @if(session()->has('token'))
            var token = "{{ session('token') }}"; // Получаем строку из переменной PHP
            localStorage.setItem('access_token', token);
            @endif
        // Добавляем строку в localStorage
    </script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Chatra {literal} -->
{{--    <script>--}}
{{--        (function(d, w, c) {--}}
{{--            w.ChatraID = 'rKu2fNzBoe4kKH7fM';--}}
{{--            var s = d.createElement('script');--}}
{{--            w[c] = w[c] || function() {--}}
{{--                (w[c].q = w[c].q || []).push(arguments);--}}
{{--            };--}}
{{--            s.async = true;--}}
{{--            s.src = 'https://call.chatra.io/chatra.js';--}}
{{--            if (d.head) d.head.appendChild(s);--}}
{{--        })(document, window, 'Chatra');--}}
{{--    </script>--}}
    <!-- /Chatra {/literal} -->
    <title>JWT SPA</title>
</head>
<body class="p-5">

<div id="app">
    @yield('content')
</div>
</body>
</html>
