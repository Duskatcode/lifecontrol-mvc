@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
    <h1>Calendario de eventos</h1>

    @if (session('success'))
        <div class="card" style="border-left: 5px solid #16a34a;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <a class="btn" href="{{ route('events.create') }}">Crear evento</a>
    </div>

    <div class="card">
        <h2>Próximos eventos</h2>

        @forelse ($upcomingEvents as $event)
            <p>
                <strong>{{ $event->event_date->format('Y-m-d') }}</strong>
                {{ $event->event_time ? substr($event->event_time, 0, 5) : '' }}
                — {{ $event->title }}
            </p>
        @empty
            <p>No hay próximos eventos.</p>
        @endforelse
    </div>

    <div class="card">
        <form method="GET" action="{{ route('events.index') }}">
            <input type="date" name="date" value="{{ request('date') }}" style="padding: 10px;">
            <button class="btn" type="submit">Filtrar por fecha</button>
            <a class="btn" href="{{ route('events.index') }}">Limpiar</a>
        </form>
    </div>

    <div class="card">
        @if ($events->isEmpty())
            <p>No hay eventos registrados.</p>
        @else
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Título</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Fecha</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Hora</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Recordatorio</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td style="padding: 10px;">
                                <strong>{{ $event->title }}</strong>
                                <br>
                                <span class="muted">{{ $event->description ?: 'Sin descripción' }}</span>
                            </td>
                            <td style="padding: 10px;">{{ $event->event_date->format('Y-m-d') }}</td>
                            <td style="padding: 10px;">{{ $event->event_time ? substr($event->event_time, 0, 5) : 'Sin hora' }}</td>
                            <td style="padding: 10px;">{{ $event->reminder_at ? $event->reminder_at->format('Y-m-d H:i') : 'Sin recordatorio' }}</td>
                            <td style="padding: 10px;">
                                <a class="btn" href="{{ route('events.edit', $event) }}">Editar</a>

                                <form method="POST" action="{{ route('events.destroy', $event) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit" onclick="return confirm('¿Eliminar este evento?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
