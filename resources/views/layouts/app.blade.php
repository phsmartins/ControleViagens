<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Viagens - Gênesis</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://kit.fontawesome.com/545cb6747b.js" crossorigin="anonymous"></script>
</head>
<body>

    <main>
        <aside>
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Home</a></li>
                    <li><a href="{{ route('vehicles.index') }}"><i class="fa-solid fa-bus"></i> Veículos</a></li>
                    <li><a href="{{ route('drivers.index') }}"><i class="fa-solid fa-id-card"></i> Motoristas</a></li>
                    <li><a href="{{ route('trips.index') }}"><i class="fa-solid fa-compass"></i> Viagens</a></li>
                </ul>
            </nav>
        </aside>

        <section class="container">
            <div class="content">
                @yield('content')
            </div>
        </section>
    </main>

</body>
</html>
