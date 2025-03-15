<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Petstore')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="content-wrapper">
        <header>
            <nav>
                <ul>
                    <li><a href="{{ route('pets.index') }}">Strona główna</a></li>
                </ul>
            </nav>
        </header>

        <main style="padding: 0px 20px;">
            @yield('content')
        </main>
    </div>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Petstore. Wszystkie prawa zastrzeżone.</p>
    </footer>
</body>

</html>
