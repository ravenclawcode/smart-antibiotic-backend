<!doctype html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>@yield('title') | Smart Antibiotik</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}?v=3">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>

<body>

    <div class="d-flex">

        @include('partials.sidebar')

        <div class="flex-grow-1 d-flex flex-column content-wrapper">

            @include('partials.navbar')

            <main class="flex-grow-1 p-4">

                @yield('content')

            </main>

            @include('partials.footer')

        </div>

    </div>

</body>

</html>