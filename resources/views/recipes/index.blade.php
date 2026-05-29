@extends('layouts.app')

@section('title', 'Recetas')

@section('content')
    <h1>Plataforma de recetas</h1>

    @if (session('success'))
        <div class="card" style="border-left: 5px solid #16a34a;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <a class="btn" href="{{ route('recipes.create') }}">Crear receta</a>
    </div>

    <div class="card">
        <form method="GET" action="{{ route('recipes.index') }}">
            <input
                type="text"
                name="search"
                placeholder="Buscar por título, ingrediente o categoría"
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
            <a class="btn" href="{{ route('recipes.index') }}">Limpiar</a>
        </form>
    </div>

    <div class="grid">
        @forelse ($recipes as $recipe)
            <div class="card">
                <h3>{{ $recipe->title }}</h3>
                <p class="muted">Categoría: {{ $recipe->category ?: 'Sin categoría' }}</p>

                <h4>Ingredientes</h4>
                <p>{{ $recipe->ingredients }}</p>

                <h4>Preparación</h4>
                <p>{{ $recipe->instructions }}</p>

                <a class="btn" href="{{ route('recipes.edit', $recipe) }}">Editar</a>

                <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn" type="submit" onclick="return confirm('¿Eliminar esta receta?')">
                        Eliminar
                    </button>
                </form>
            </div>
        @empty
            <div class="card">
                <p>No hay recetas registradas.</p>
            </div>
        @endforelse
    </div>
@endsection
