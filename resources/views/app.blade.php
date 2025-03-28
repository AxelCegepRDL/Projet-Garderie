<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestion des garderies</title>
</head>
<style>
    #logo {
        width: 100px;
    }

    #navbar {
        background-color: rgb(182, 228, 249);
    }

    #navbar a {
        color: rgb(94, 99, 102);
    }

    #navbar a:hover {
        color: rgb(119, 126, 131);
        text-decoration: underline;
    }

    a {
        text-decoration: none;
    }
</style>

<body>

    @include('navbar')
    @yield('content')
    <hr>
    <footer>
        <center><span>© 2025 - Gestion des garderies</span></center>
    </footer>
</body>

</html>