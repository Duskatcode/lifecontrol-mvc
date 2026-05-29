@extends('layouts.app')

@section('title', 'Generador de contraseñas')

@section('content')
    <h1>Generador de contraseñas</h1>

    <div class="card">
        <form method="POST" action="{{ route('passwords.generate') }}">
            @csrf

            <div style="margin-bottom: 16px;">
                <label for="length">Longitud de la contraseña</label>
                <input
                    type="number"
                    id="length"
                    name="length"
                    min="6"
                    max="64"
                    value="{{ old('length', $length ?? 12) }}"
                    style="width: 100%; padding: 10px; margin-top: 6px;"
                >

                @error('length')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label>
                    <input
                        type="checkbox"
                        name="include_uppercase"
                        value="1"
                        @checked(old('include_uppercase', $includeUppercase ?? true))
                    >
                    Incluir mayúsculas
                </label>
            </div>

            <div style="margin-bottom: 16px;">
                <label>
                    <input
                        type="checkbox"
                        name="include_lowercase"
                        value="1"
                        @checked(old('include_lowercase', $includeLowercase ?? true))
                    >
                    Incluir minúsculas
                </label>
            </div>

            <div style="margin-bottom: 16px;">
                <label>
                    <input
                        type="checkbox"
                        name="include_numbers"
                        value="1"
                        @checked(old('include_numbers', $includeNumbers ?? true))
                    >
                    Incluir números
                </label>
            </div>

            <div style="margin-bottom: 16px;">
                <label>
                    <input
                        type="checkbox"
                        name="include_symbols"
                        value="1"
                        @checked(old('include_symbols', $includeSymbols ?? false))
                    >
                    Incluir símbolos
                </label>
            </div>

            @error('characters')
                <p style="color: #dc2626;">{{ $message }}</p>
            @enderror

            <button class="btn" type="submit">Generar contraseña</button>
        </form>
    </div>

    @isset($password)
        <div class="card">
            <h2>Contraseña generada</h2>

            <input
                type="text"
                value="{{ $password }}"
                readonly
                style="width: 100%; padding: 12px; font-size: 18px; font-family: monospace;"
            >

            <p class="muted">
                Longitud: {{ strlen($password) }} caracteres.
            </p>
        </div>
    @endisset
@endsection
