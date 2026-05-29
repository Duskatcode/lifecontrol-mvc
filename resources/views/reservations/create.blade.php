@extends('layouts.app')

@section('title', 'Crear reserva')

@section('content')
    <h1>Crear reserva</h1>

    <div class="card">
        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf

            <div style="margin-bottom: 16px;">
                <label for="name">Nombre del cliente</label>
                <input id="name" name="name" value="{{ old('name') }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('name') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="service">Servicio</label>
                <input id="service" name="service" value="{{ old('service') }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('service') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="reservation_date">Fecha</label>
                <input id="reservation_date" name="reservation_date" type="date" value="{{ old('reservation_date') }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('reservation_date') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="reservation_time">Hora</label>
                <input id="reservation_time" name="reservation_time" type="time" value="{{ old('reservation_time') }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('reservation_time') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="status">Estado</label>
                <select id="status" name="status" style="width: 100%; padding: 10px; margin-top: 6px;">
                    <option value="pendiente" @selected(old('status') === 'pendiente')>Pendiente</option>
                    <option value="confirmada" @selected(old('status') === 'confirmada')>Confirmada</option>
                    <option value="cancelada" @selected(old('status') === 'cancelada')>Cancelada</option>
                </select>
                @error('status') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <button class="btn" type="submit">Guardar</button>
            <a class="btn" href="{{ route('reservations.index') }}">Volver</a>
        </form>
    </div>
@endsection
