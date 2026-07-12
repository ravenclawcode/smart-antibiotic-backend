<!doctype html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>@yield('title') | Smart Antibiotik</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

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