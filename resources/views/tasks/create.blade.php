@extends('layouts.app')

@section('title', 'Crear tarea')

@section('content')
    <h1>Crear tarea</h1>

    <div class="card">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <div style="margin-bottom: 16px;">
                <label for="title">Título</label>
                <input
                    id="title"
                    name="title"
                    type="text"
                    value="{{ old('title') }}"
                    style="width: 100%; padding: 10px; margin-top: 6px;"
                >

                @error('title')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="description">Descripción</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    style="width: 100%; padding: 10px; margin-top: 6px;"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn" type="submit">Guardar</button>
            <a class="btn" href="{{ route('tasks.index') }}">Volver</a>
        </form>
    </div>
@endsection
