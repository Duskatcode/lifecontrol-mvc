@extends('layouts.app')

@section('title', 'Encuestas')

@section('content')
    <h1>Plataforma de encuestas</h1>

    @if (session('success'))
        <div class="card" style="border-left: 5px solid #16a34a;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <a class="btn" href="{{ route('surveys.create') }}">Crear encuesta</a>
    </div>

    <div class="grid">
        @forelse ($surveys as $survey)
            <div class="card">
                <h3>{{ $survey->title }}</h3>
                <p class="muted">{{ $survey->description ?: 'Sin descripción' }}</p>

                <p><strong>Preguntas:</strong> {{ $survey->questions_count }}</p>
                <p><strong>Respuestas registradas:</strong> {{ $survey->responses_count }}</p>

                <a class="btn" href="{{ route('surveys.show', $survey) }}">Ver</a>
                <a class="btn" href="{{ route('surveys.questions.create', $survey) }}">Preguntas</a>
                <a class="btn" href="{{ route('surveys.respond', $survey) }}">Responder</a>
                <a class="btn" href="{{ route('surveys.results', $survey) }}">Resultados</a>
                <a class="btn" href="{{ route('surveys.edit', $survey) }}">Editar</a>

                <form method="POST" action="{{ route('surveys.destroy', $survey) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn" type="submit" onclick="return confirm('¿Eliminar esta encuesta?')">
                        Eliminar
                    </button>
                </form>
            </div>
        @empty
            <div class="card">
                <p>No hay encuestas registradas.</p>
            </div>
        @endforelse
    </div>
@endsection
