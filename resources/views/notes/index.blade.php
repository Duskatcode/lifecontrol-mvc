@extends('layouts.app')

@section('title', 'Notas')

@section('content')
    <h1>Gestor de notas</h1>

    @if (session('success'))
        <div class="card" style="border-left: 5px solid #16a34a;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <a class="btn" href="{{ route('notes.create') }}">Crear nota</a>
    </div>

    <div class="card">
        <form method="GET" action="{{ route('notes.index') }}">
            <input
                type="text"
                name="search"
                placeholder="Buscar por título, contenido o categoría"
                value="{{ request('search') }}"
                style="width: 45%; padding: 10px;"
            >

            <select name="category" style="width: 30%; padding: 10px;">
                <option value="">Todas las categorías</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>
                        {{ $category }}
                    </option>
                @endforeach
            </select>

            <button class="btn" type="submit">Filtrar</button>
            <a class="btn" href="{{ route('notes.index') }}">Limpiar</a>
        </form>
    </div>

    <div class="grid">
        @forelse ($notes as $note)
            <div class="card">
                <h3>{{ $note->title }}</h3>
                <p class="muted">Categoría: {{ $note->category ?: 'Sin categoría' }}</p>
                <p>{{ $note->content }}</p>

                <a class="btn" href="{{ route('notes.edit', $note) }}">Editar</a>

                <form method="POST" action="{{ route('notes.destroy', $note) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn" type="submit" onclick="return confirm('¿Eliminar esta nota?')">
                        Eliminar
                    </button>
                </form>
            </div>
        @empty
            <div class="card">
                <p>No hay notas registradas.</p>
            </div>
        @endforelse
    </div>
@endsection
