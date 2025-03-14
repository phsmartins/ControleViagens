<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Viagens - Gênesis</title>

    <script src="https://kit.fontawesome.com/545cb6747b.js" crossorigin="anonymous"></script>
</head>
<body>
<nav>
    <a href="{{ url('/') }}">Home</a>
    <a href="{{ route('vehicles.create') }}">Adicionar Veículo</a>
</nav>
<hr>
@yield('content')
</body>
</html>
