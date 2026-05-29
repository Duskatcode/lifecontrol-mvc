@extends('layouts.app')

@section('title', 'Dashboard - LifeControl MVC')

@section('content')
    <h1>Dashboard principal</h1>

    <p class="muted">
        Plataforma modular desarrollada con arquitectura MVC para integrar herramientas
        de productividad, gestión y utilidades interactivas.
    </p>

    <div class="grid">
        <div class="card">
            <h3>Lista de tareas</h3>
            <p>Gestiona tareas pendientes y completadas.</p>
            <a class="btn" href="{{ route('tasks.index') }}">Entrar</a>
        </div>

        <div class="card">
            <h3>Calculadora de propinas</h3>
            <p>Calcula propinas según monto y porcentaje.</p>
            <a class="btn" href="{{ route('tips.index') }}">Entrar</a>
        </div>

        <div class="card">
            <h3>Generador de contraseñas</h3>
            <p>Genera contraseñas seguras aleatorias.</p>
            <a class="btn" href="{{ route('passwords.index') }}">Entrar</a>
        </div>

        <div class="card">
            <h3>Gestor de gastos</h3>
            <p>Registra gastos diarios y consulta resúmenes.</p>
            <a class="btn" href="{{ route('expenses.index') }}">Entrar</a>
        </div>

        <div class="card">
            <h3>Sistema de reservas</h3>
            <p>Administra citas o servicios reservados.</p>
            <a class="btn" href="{{ route('reservations.index') }}">Entrar</a>
        </div>

        <div class="card">
            <h3>Gestor de notas</h3>
            <p>Guarda notas organizadas por categorías.</p>
            <a class="btn" href="{{ route('notes.index') }}">Entrar</a>
        </div>

        <div class="card">
            <h3>Calendario de eventos</h3>
            <p>Administra eventos y recordatorios.</p>
            <a class="btn" href="{{ route('events.index') }}">Entrar</a>
        </div>

        <div class="card">
            <h3>Plataforma de recetas</h3>
            <p>Guarda y consulta recetas por categoría.</p>
            <a class="btn" href="{{ route('recipes.index') }}">Entrar</a>
        </div>

        <div class="card">
            <h3>Juego de memoria</h3>
            <p>Empareja cartas y calcula puntaje.</p>
            <a class="btn" href="{{ route('memory.index') }}">Entrar</a>
        </div>

        <div class="card">
            <h3>Plataforma de encuestas</h3>
            <p>Crea encuestas y consulta resultados.</p>
            <a class="btn" href="{{ route('surveys.index') }}">Entrar</a>
        </div>

        <div class="card">
            <h3>Cronómetro online</h3>
            <p>Inicia, pausa, reinicia y registra vueltas.</p>
            <a class="btn" href="{{ route('stopwatch.index') }}">Entrar</a>
        </div>
    </div>
@endsection
