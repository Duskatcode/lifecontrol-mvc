@extends('layouts.app')

@section('title', 'Detalle de encuesta')

@section('content')
    <h1>{{ $survey->title }}</h1>

    @if (session('success'))
        <div class="card" style="border-left: 5px solid #16a34a;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <p>{{ $survey->description ?: 'Sin descripción' }}</p>

        <a class="btn" href="{{ route('surveys.questions.create', $survey) }}">Administrar preguntas</a>
        <a class="btn" href="{{ route('surveys.respond', $survey) }}">Responder encuesta</a>
        <a class="btn" href="{{ route('surveys.results', $survey) }}">Ver resultados</a>
        <a class="btn" href="{{ route('surveys.index') }}">Volver</a>
    </div>

    <div class="card">
        <h2>Preguntas</h2>

        @forelse ($survey->questions as $question)
            <div style="margin-bottom: 20px;">
                <h3>{{ $question->question }}</h3>

                <ul>
                    @foreach ($question->options as $option)
                        <li>{{ $option->option_text }}</li>
                    @endforeach
                </ul>
            </div>
        @empty
            <p>Esta encuesta todavía no tiene preguntas.</p>
        @endforelse
    </div>
@endsection
