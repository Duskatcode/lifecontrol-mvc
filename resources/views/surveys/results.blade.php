@extends('layouts.app')

@section('title', 'Resultados de encuesta')

@section('content')
    <h1>Resultados: {{ $survey->title }}</h1>

    @if (session('success'))
        <div class="card" style="border-left: 5px solid #16a34a;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <p>{{ $survey->description ?: 'Sin descripción' }}</p>
        <a class="btn" href="{{ route('surveys.respond', $survey) }}">Responder otra vez</a>
        <a class="btn" href="{{ route('surveys.index') }}">Volver</a>
    </div>

    @forelse ($survey->questions as $question)
        @php
            $questionTotal = $question->options->sum(fn ($option) => $option->responses->count());
        @endphp

        <div class="card">
            <h2>{{ $question->question }}</h2>
            <p class="muted">Total de respuestas: {{ $questionTotal }}</p>

            @foreach ($question->options as $option)
                @php
                    $count = $option->responses->count();
                    $percentage = $questionTotal > 0 ? round(($count / $questionTotal) * 100, 1) : 0;
                @endphp

                <div style="margin-bottom: 16px;">
                    <p>
                        <strong>{{ $option->option_text }}</strong>
                        — {{ $count }} respuestas — {{ $percentage }}%
                    </p>

                    <div style="background: #e5e7eb; border-radius: 8px; overflow: hidden;">
                        <div style="width: {{ $percentage }}%; background: #2563eb; color: white; padding: 6px;">
                            {{ $percentage }}%
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="card">
            <p>Esta encuesta todavía no tiene preguntas.</p>
        </div>
    @endforelse
@endsection
