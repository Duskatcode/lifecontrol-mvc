@extends('layouts.app')

@section('title', 'Crear nota')

@section('content')
    <h1>Crear nota</h1>

    <div class="card">
        <form method="POST" action="{{ route('notes.store') }}">
            @csrf

            <div style="margin-bottom: 16px;">
                <label for="title">Título</label>
                <input id="title" name="title" value="{{ old('title') }}" style="width: 100%; padding: 10px; margin-top: 6px;">

                @error('title')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="category">Categoría</label>
                <input id="category" name="category" value="{{ old('category') }}" style="width: 100%; padding: 10px; margin-top: 6px;">

                @error('category')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="content">Contenido</label>
                <textarea id="content" name="content" rows="7" style="width: 100%; padding: 10px; margin-top: 6px;">{{ old('content') }}</textarea>

                @error('content')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn" type="submit">Guardar</button>
            <a class="btn" href="{{ route('notes.index') }}">Volver</a>
        </form>
    </div>
@endsection
