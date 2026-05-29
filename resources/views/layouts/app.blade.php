<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'LifeControl MVC')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #1f2937;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 270px;
            background: #111827;
            color: white;
            padding: 22px;
        }

        .sidebar h2 {
            margin-top: 0;
            margin-bottom: 24px;
            font-size: 22px;
        }

        .sidebar a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 11px 0;
            border-bottom: 1px solid #1f2937;
            font-size: 15px;
        }

        .sidebar a:hover {
            color: #ffffff;
        }

        .content {
            flex: 1;
            padding: 32px;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 14px;
            border-radius: 7px;
            text-decoration: none;
            margin-top: 10px;
            font-size: 14px;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .muted {
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="app">
        <aside class="sidebar">
            <h2>LifeControl MVC</h2>

            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('tasks.index') }}">Tareas</a>
            <a href="{{ route('tips.index') }}">Calculadora de propinas</a>
            <a href="{{ route('passwords.index') }}">Generador de contraseñas</a>
            <a href="{{ route('expenses.index') }}">Gastos</a>
            <a href="{{ route('reservations.index') }}">Reservas</a>
            <a href="{{ route('notes.index') }}">Notas</a>
            <a href="{{ route('events.index') }}">Eventos</a>
            <a href="{{ route('recipes.index') }}">Recetas</a>
            <a href="{{ route('memory.index') }}">Juego de memoria</a>
            <a href="{{ route('surveys.index') }}">Encuestas</a>
            <a href="{{ route('stopwatch.index') }}">Cronómetro</a>
        </aside>

        <main class="content">
            @yield('content')
        </main>
    </div>
</body>
</html>
