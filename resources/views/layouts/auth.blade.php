<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Login Admin') | Smart Antibiotik</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>

<body class="login-page">

    <div class="container">

        @yield('content')

    </div>

</body>

</html>