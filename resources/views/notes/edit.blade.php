@extends('layouts.app')

@section('title', 'Editar nota')

@section('content')
    <h1>Editar nota</h1>

    <div class="card">
        <form method="POST" action="{{ route('notes.update', $note) }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 16px;">
                <label for="title">Título</label>
                <input id="title" name="title" value="{{ old('title', $note->title) }}" style="width: 100%; padding: 10px; margin-top: 6px;">

                @error('title')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="category">Categoría</label>
                <input id="category" name="category" value="{{ old('category', $note->category) }}" style="width: 100%; padding: 10px; margin-top: 6px;">

                @error('category')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="content">Contenido</label>
                <textarea id="content" name="content" rows="7" style="width: 100%; padding: 10px; margin-top: 6px;">{{ old('content', $note->content) }}</textarea>

                @error('content')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn" type="submit">Actualizar</button>
            <a class="btn" href="{{ route('notes.index') }}">Volver</a>
        </form>
    </div>
@endsection
