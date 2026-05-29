@extends('layouts.app')

@section('title', 'Reservas')

@section('content')
    <h1>Sistema de reservas</h1>

    @if (session('success'))
        <div class="card" style="border-left: 5px solid #16a34a;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <a class="btn" href="{{ route('reservations.create') }}">Crear reserva</a>
    </div>

    <div class="card">
        @if ($reservations->isEmpty())
            <p>No hay reservas registradas.</p>
        @else
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Nombre</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Servicio</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Fecha</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Hora</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Estado</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td style="padding: 10px;">{{ $reservation->name }}</td>
                            <td style="padding: 10px;">{{ $reservation->service }}</td>
                            <td style="padding: 10px;">{{ $reservation->reservation_date->format('Y-m-d') }}</td>
                            <td style="padding: 10px;">{{ substr($reservation->reservation_time, 0, 5) }}</td>
                            <td style="padding: 10px;">{{ ucfirst($reservation->status) }}</td>
                            <td style="padding: 10px;">
                                <a class="btn" href="{{ route('reservations.edit', $reservation) }}">Editar</a>

                                <form method="POST" action="{{ route('reservations.destroy', $reservation) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit" onclick="return confirm('¿Eliminar esta reserva?')">
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
