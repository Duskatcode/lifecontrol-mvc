@extends('layouts.app')

@section('title', 'Editar receta')

@section('content')
    <h1>Editar receta</h1>

    <div class="card">
        <form method="POST" action="{{ route('recipes.update', $recipe) }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 16px;">
                <label for="title">Título</label>
                <input id="title" name="title" value="{{ old('title', $recipe->title) }}" style="width: 100%; padding: 10px; margin-top: 6px;">

                @error('title')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="category">Categoría</label>
                <input id="category" name="category" value="{{ old('category', $recipe->category) }}" style="width: 100%; padding: 10px; margin-top: 6px;">

                @error('category')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="ingredients">Ingredientes</label>
                <textarea id="ingredients" name="ingredients" rows="5" style="width: 100%; padding: 10px; margin-top: 6px;">{{ old('ingredients', $recipe->ingredients) }}</textarea>

                @error('ingredients')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="instructions">Preparación</label>
                <textarea id="instructions" name="instructions" rows="7" style="width: 100%; padding: 10px; margin-top: 6px;">{{ old('instructions', $recipe->instructions) }}</textarea>

                @error('instructions')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn" type="submit">Actualizar</button>
            <a class="btn" href="{{ route('recipes.index') }}">Volver</a>
        </form>
    </div>
@endsection
