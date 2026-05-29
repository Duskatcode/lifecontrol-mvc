@extends('layouts.app')

@section('title', 'Dashboard - LifeControl MVC')

@section('content')
    <h1>Dashboard principal</h1>

    <p class="muted">
        Resumen general de la aplicación modular MVC. Aquí se muestran datos reales
        de productividad, gestión y utilidades.
    </p>

    <div class="grid">
        <div class="card">
            <h3>Tareas pendientes</h3>
            <p style="font-size: 34px; font-weight: bold;">{{ $taskStats['pending'] }}</p>
            <p class="muted">
                {{ $taskStats['completed'] }} completadas de {{ $taskStats['total'] }} tareas.
            </p>
            <a class="btn" href="{{ route('tasks.index') }}">Ver tareas</a>
        </div>

        <div class="card">
            <h3>Gastos del mes</h3>
            <p style="font-size: 34px; font-weight: bold;">
                ${{ number_format($expenseStats['current_month_total'], 2) }}
            </p>
            <p class="muted">
                {{ $expenseStats['count'] }} gastos registrados.
            </p>
            <a class="btn" href="{{ route('expenses.index') }}">Ver gastos</a>
        </div>

        <div class="card">
            <h3>Reservas pendientes</h3>
            <p style="font-size: 34px; font-weight: bold;">{{ $reservationStats['pending'] }}</p>
            <p class="muted">
                {{ $reservationStats['confirmed'] }} confirmadas,
                {{ $reservationStats['cancelled'] }} canceladas.
            </p>
            <a class="btn" href="{{ route('reservations.index') }}">Ver reservas</a>
        </div>

        <div class="card">
            <h3>Eventos próximos</h3>
            <p style="font-size: 34px; font-weight: bold;">{{ $eventStats['upcoming'] }}</p>
            <p class="muted">
                {{ $eventStats['total'] }} eventos registrados.
            </p>
            <a class="btn" href="{{ route('events.index') }}">Ver eventos</a>
        </div>

        <div class="card">
            <h3>Notas guardadas</h3>
            <p style="font-size: 34px; font-weight: bold;">{{ $contentStats['notes'] }}</p>
            <p class="muted">Notas disponibles para consulta rápida.</p>
            <a class="btn" href="{{ route('notes.index') }}">Ver notas</a>
        </div>

        <div class="card">
            <h3>Recetas guardadas</h3>
            <p style="font-size: 34px; font-weight: bold;">{{ $contentStats['recipes'] }}</p>
            <p class="muted">Recetas registradas en la plataforma.</p>
            <a class="btn" href="{{ route('recipes.index') }}">Ver recetas</a>
        </div>

        <div class="card">
            <h3>Encuestas</h3>
            <p style="font-size: 34px; font-weight: bold;">{{ $surveyStats['surveys'] }}</p>
            <p class="muted">
                {{ $surveyStats['questions'] }} preguntas,
                {{ $surveyStats['responses'] }} respuestas individuales.
            </p>
            <a class="btn" href="{{ route('surveys.index') }}">Ver encuestas</a>
        </div>

        <div class="card">
            <h3>Utilidades</h3>
            <p class="muted">
                Herramientas rápidas sin base de datos.
            </p>
            <a class="btn" href="{{ route('tips.index') }}">Propinas</a>
            <a class="btn" href="{{ route('passwords.index') }}">Contraseñas</a>
            <a class="btn" href="{{ route('stopwatch.index') }}">Cronómetro</a>
            <a class="btn" href="{{ route('memory.index') }}">Memoria</a>
        </div>
    </div>

    <div class="grid">
        <div class="card">
            <h2>Últimas tareas</h2>

            @forelse ($latestTasks as $task)
                <p>
                    <strong>{{ $task->title }}</strong>
                    <br>
                    <span class="muted">
                        Estado: {{ $task->is_completed ? 'Completada' : 'Pendiente' }}
                    </span>
                </p>
            @empty
                <p>No hay tareas registradas.</p>
            @endforelse

            <a class="btn" href="{{ route('tasks.index') }}">Ir a tareas</a>
        </div>

        <div class="card">
            <h2>Próximas reservas</h2>

            @forelse ($upcomingReservations as $reservation)
                <p>
                    <strong>{{ $reservation->name }}</strong>
                    <br>
                    {{ $reservation->service }}
                    <br>
                    <span class="muted">
                        {{ $reservation->reservation_date->format('Y-m-d') }}
                        {{ substr($reservation->reservation_time, 0, 5) }}
                        — {{ ucfirst($reservation->status) }}
                    </span>
                </p>
            @empty
                <p>No hay próximas reservas.</p>
            @endforelse

            <a class="btn" href="{{ route('reservations.index') }}">Ir a reservas</a>
        </div>

        <div class="card">
            <h2>Próximos eventos</h2>

            @forelse ($upcomingEvents as $event)
                <p>
                    <strong>{{ $event->title }}</strong>
                    <br>
                    <span class="muted">
                        {{ $event->event_date->format('Y-m-d') }}
                        {{ $event->event_time ? substr($event->event_time, 0, 5) : 'Sin hora' }}
                    </span>
                </p>
            @empty
                <p>No hay próximos eventos.</p>
            @endforelse

            <a class="btn" href="{{ route('events.index') }}">Ir a eventos</a>
        </div>

        <div class="card">
            <h2>Últimas notas</h2>

            @forelse ($latestNotes as $note)
                <p>
                    <strong>{{ $note->title }}</strong>
                    <br>
                    <span class="muted">
                        {{ $note->category ?: 'Sin categoría' }}
                    </span>
                </p>
            @empty
                <p>No hay notas registradas.</p>
            @endforelse

            <a class="btn" href="{{ route('notes.index') }}">Ir a notas</a>
        </div>

        <div class="card">
            <h2>Últimas encuestas</h2>

            @forelse ($latestSurveys as $survey)
                <p>
                    <strong>{{ $survey->title }}</strong>
                    <br>
                    <span class="muted">
                        {{ $survey->questions_count }} preguntas,
                        {{ $survey->responses_count }} respuestas individuales.
                    </span>
                </p>
            @empty
                <p>No hay encuestas registradas.</p>
            @endforelse

            <a class="btn" href="{{ route('surveys.index') }}">Ir a encuestas</a>
        </div>

        <div class="card">
            <h2>Acciones rápidas</h2>

            <a class="btn" href="{{ route('tasks.create') }}">Nueva tarea</a>
            <a class="btn" href="{{ route('expenses.create') }}">Registrar gasto</a>
            <a class="btn" href="{{ route('reservations.create') }}">Nueva reserva</a>
            <a class="btn" href="{{ route('events.create') }}">Nuevo evento</a>
            <a class="btn" href="{{ route('notes.create') }}">Nueva nota</a>
            <a class="btn" href="{{ route('recipes.create') }}">Nueva receta</a>
            <a class="btn" href="{{ route('surveys.create') }}">Nueva encuesta</a>
        </div>
    </div>
@endsection
