@extends('layouts.app')

@section('title', 'Editar encuesta')

@section('content')
    <h1>Editar encuesta</h1>

    <div class="card">
        <form method="POST" action="{{ route('surveys.update', $survey) }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 16px;">
                <label for="title">Título</label>
                <input id="title" name="title" value="{{ old('title', $survey->title) }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('title') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" rows="4" style="width: 100%; padding: 10px; margin-top: 6px;">{{ old('description', $survey->description) }}</textarea>
                @error('description') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <button class="btn" type="submit">Actualizar</button>
            <a class="btn" href="{{ route('surveys.index') }}">Volver</a>
        </form>
    </div>
@endsection
