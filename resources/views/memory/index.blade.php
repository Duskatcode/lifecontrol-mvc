@extends('layouts.app')

@section('title', 'Juego de memoria')

@section('content')
    <h1>Juego de memoria</h1>

    <div class="card">
        <p class="muted">
            Encuentra todas las parejas de cartas. El puntaje disminuye según el número
            de movimientos y el tiempo utilizado.
        </p>
    </div>

    <div class="card">
        <label for="difficulty">Dificultad</label>

        <select id="difficulty" style="padding: 10px; margin-left: 10px;">
            <option value="easy">Fácil — 4 parejas</option>
            <option value="medium">Media — 6 parejas</option>
            <option value="hard">Difícil — 8 parejas</option>
        </select>

        <button class="btn" type="button" id="restart-game">
            Reiniciar juego
        </button>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Movimientos</h3>
            <p id="moves" style="font-size: 28px; font-weight: bold;">0</p>
        </div>

        <div class="card">
            <h3>Parejas</h3>
            <p id="pairs" style="font-size: 28px; font-weight: bold;">0/0</p>
        </div>

        <div class="card">
            <h3>Tiempo</h3>
            <p id="timer" style="font-size: 28px; font-weight: bold;">00:00</p>
        </div>

        <div class="card">
            <h3>Puntaje</h3>
            <p id="score" style="font-size: 28px; font-weight: bold;">0</p>
        </div>

        <div class="card">
            <h3>Mejor puntaje</h3>
            <p id="best-score" style="font-size: 28px; font-weight: bold;">Sin registro</p>
        </div>
    </div>

    <div class="card">
        <p id="game-message" class="muted">
            Selecciona dos cartas para encontrar una pareja.
        </p>

        <div id="memory-board" class="memory-board"></div>
    </div>

    <style>
        .memory-board {
            display: grid;
            gap: 14px;
            margin-top: 20px;
            max-width: 760px;
        }

        .memory-board.easy {
            grid-template-columns: repeat(4, 1fr);
        }

        .memory-board.medium {
            grid-template-columns: repeat(4, 1fr);
        }

        .memory-board.hard {
            grid-template-columns: repeat(4, 1fr);
        }

        .memory-card {
            min-height: 95px;
            border: none;
            border-radius: 14px;
            background: #1f2937;
            color: #ffffff;
            font-size: 36px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .memory-card:hover {
            transform: translateY(-2px);
        }

        .memory-card.flipped {
            background: #2563eb;
        }

        .memory-card.matched {
            background: #16a34a;
            cursor: default;
        }

        @media (max-width: 700px) {
            .memory-board.easy,
            .memory-board.medium,
            .memory-board.hard {
                grid-template-columns: repeat(2, 1fr);
            }

            .memory-card {
                min-height: 80px;
                font-size: 30px;
            }
        }
    </style>

    <script src="{{ asset('js/memory-game.js') }}"></script>
@endsection
