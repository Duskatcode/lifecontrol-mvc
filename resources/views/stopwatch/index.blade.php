@extends('layouts.app')

@section('title', 'Cronómetro')

@section('content')
    <h1>Cronómetro online</h1>

    <div class="card">
        <div
            id="display"
            style="font-size: 48px; font-weight: bold; font-family: monospace; margin-bottom: 20px;"
        >
            00:00:00.000
        </div>

        <button class="btn" type="button" onclick="startStopwatch()">Iniciar</button>
        <button class="btn" type="button" onclick="pauseStopwatch()">Pausar</button>
        <button class="btn" type="button" onclick="resetStopwatch()">Reiniciar</button>
        <button class="btn" type="button" onclick="addLap()">Registrar vuelta</button>
    </div>

    <div class="card">
        <h2>Vueltas</h2>
        <ol id="laps"></ol>
    </div>

    <script>
        let startTime = 0;
        let elapsedTime = 0;
        let timerInterval = null;
        let isRunning = false;

        function formatTime(milliseconds) {
            const hours = Math.floor(milliseconds / 3600000);
            const minutes = Math.floor((milliseconds % 3600000) / 60000);
            const seconds = Math.floor((milliseconds % 60000) / 1000);
            const ms = milliseconds % 1000;

            return String(hours).padStart(2, '0') + ':' +
                String(minutes).padStart(2, '0') + ':' +
                String(seconds).padStart(2, '0') + '.' +
                String(ms).padStart(3, '0');
        }

        function updateDisplay() {
            const currentTime = Date.now();
            const totalTime = elapsedTime + (currentTime - startTime);

            document.getElementById('display').textContent = formatTime(totalTime);
        }

        function startStopwatch() {
            if (isRunning) {
                return;
            }

            startTime = Date.now();
            timerInterval = setInterval(updateDisplay, 10);
            isRunning = true;
        }

        function pauseStopwatch() {
            if (!isRunning) {
                return;
            }

            elapsedTime += Date.now() - startTime;
            clearInterval(timerInterval);
            timerInterval = null;
            isRunning = false;
        }

        function resetStopwatch() {
            clearInterval(timerInterval);

            startTime = 0;
            elapsedTime = 0;
            timerInterval = null;
            isRunning = false;

            document.getElementById('display').textContent = '00:00:00.000';
            document.getElementById('laps').innerHTML = '';
        }

        function addLap() {
            const currentValue = document.getElementById('display').textContent;
            const laps = document.getElementById('laps');

            const item = document.createElement('li');
            item.textContent = currentValue;

            laps.appendChild(item);
        }
    </script>
@endsection
