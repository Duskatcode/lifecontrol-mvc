@extends('layouts.app')

@section('title', 'Preguntas de encuesta')

@section('content')
    <h1>Preguntas: {{ $survey->title }}</h1>

    @if (session('success'))
        <div class="card" style="border-left: 5px solid #16a34a;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('surveys.questions.store', $survey) }}">
            @csrf

            <div style="margin-bottom: 16px;">
                <label for="question">Pregunta</label>
                <input id="question" name="question" value="{{ old('question') }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('question') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <h3>Opciones</h3>

            @for ($i = 0; $i < 4; $i++)
                <div style="margin-bottom: 12px;">
                    <label>Opción {{ $i + 1 }}</label>
                    <input
                        name="options[]"
                        value="{{ old('options.' . $i) }}"
                        style="width: 100%; padding: 10px; margin-top: 6px;"
                    >
                </div>
            @endfor

            @error('options')
                <p style="color: #dc2626;">{{ $message }}</p>
            @enderror

            @error('options.*')
                <p style="color: #dc2626;">{{ $message }}</p>
            @enderror

            <button class="btn" type="submit">Agregar pregunta</button>
            <a class="btn" href="{{ route('surveys.show', $survey) }}">Ver encuesta</a>
            <a class="btn" href="{{ route('surveys.index') }}">Volver</a>
        </form>
    </div>

    <div class="card">
        <h2>Preguntas actuales</h2>

        @forelse ($survey->questions as $question)
            <div style="border-bottom: 1px solid #ddd; padding: 16px 0;">
                <h3>{{ $question->question }}</h3>

                <ul>
                    @foreach ($question->options as $option)
                        <li>{{ $option->option_text }}</li>
                    @endforeach
                </ul>

                <form method="POST" action="{{ route('survey-questions.destroy', $question) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn" type="submit" onclick="return confirm('¿Eliminar esta pregunta?')">
                        Eliminar pregunta
                    </button>
                </form>
            </div>
        @empty
            <p>No hay preguntas registradas.</p>
        @endforelse
    </div>
@endsection
