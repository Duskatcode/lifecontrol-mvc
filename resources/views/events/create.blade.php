@extends('layouts.app')

@section('title', 'Crear evento')

@section('content')
    <h1>Crear evento</h1>

    <div class="card">
        <form method="POST" action="{{ route('events.store') }}">
            @csrf

            <div style="margin-bottom: 16px;">
                <label for="title">Título</label>
                <input id="title" name="title" value="{{ old('title') }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('title') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" rows="4" style="width: 100%; padding: 10px; margin-top: 6px;">{{ old('description') }}</textarea>
                @error('description') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="event_date">Fecha</label>
                <input id="event_date" name="event_date" type="date" value="{{ old('event_date') }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('event_date') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="event_time">Hora</label>
                <input id="event_time" name="event_time" type="time" value="{{ old('event_time') }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('event_time') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="reminder_at">Recordatorio</label>
                <input id="reminder_at" name="reminder_at" type="datetime-local" value="{{ old('reminder_at') }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('reminder_at') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <button class="btn" type="submit">Guardar</button>
            <a class="btn" href="{{ route('events.index') }}">Volver</a>
        </form>
    </div>
@endsection
