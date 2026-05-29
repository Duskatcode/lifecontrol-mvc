@extends('layouts.app')

@section('title', 'Responder encuesta')

@section('content')
    <h1>Responder: {{ $survey->title }}</h1>

    <div class="card">
        <p>{{ $survey->description ?: 'Sin descripción' }}</p>
    </div>

    <form method="POST" action="{{ route('surveys.responses.store', $survey) }}">
        @csrf

        <div class="card">
            <label for="respondent_name">Nombre del participante</label>
            <input
                id="respondent_name"
                name="respondent_name"
                value="{{ old('respondent_name') }}"
                placeholder="Opcional"
                style="width: 100%; padding: 10px; margin-top: 6px;"
            >
            @error('respondent_name') <p style="color: #dc2626;">{{ $message }}</p> @enderror
        </div>

        @foreach ($survey->questions as $question)
            <div class="card">
                <h3>{{ $question->question }}</h3>

                @foreach ($question->options as $option)
                    <label style="display: block; margin-bottom: 10px;">
                        <input
                            type="radio"
                            name="answers[{{ $question->id }}]"
                            value="{{ $option->id }}"
                            @checked(old('answers.' . $question->id) == $option->id)
                        >
                        {{ $option->option_text }}
                    </label>
                @endforeach

                @error('answers.' . $question->id)
                    <p style="color: #dc2626;">Debes responder esta pregunta.</p>
                @enderror
            </div>
        @endforeach

        @error('answers')
            <p style="color: #dc2626;">{{ $message }}</p>
        @enderror

        <button class="btn" type="submit">Enviar respuestas</button>
        <a class="btn" href="{{ route('surveys.index') }}">Volver</a>
    </form>
@endsection
