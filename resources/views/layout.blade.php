<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/assets/css/app.css')}}">
    @stack('styles')
</head>
<body>

<header>
    <h1>Админ-панель</h1>
</header>

<div class="container">
    <nav>

        @auth
            <a href="{{route('courses')}}">Курсы</a>
            <a href="students.html">Студенты</a>
            <a href="{{route('logout')}}">Выход</a>
        @endauth

        @guest
            <a href="{{route('login')}}">Вход</a>
        @endguest
    </nav>

    <main>
        @yield('content')
    </main>
</div>

</body>
</html>
