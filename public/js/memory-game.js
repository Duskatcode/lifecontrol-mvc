const symbols = ['🍎', '🍌', '🍇', '🍓', '🍒', '🍍', '🥝', '🍉', '🍑', '🥥', '🍋', '🍊'];

const difficultyPairs = {
    easy: 4,
    medium: 6,
    hard: 8,
};

let cards = [];
let firstCard = null;
let secondCard = null;
let lockBoard = false;
let moves = 0;
let matchedPairs = 0;
let totalPairs = difficultyPairs.easy;
let score = 0;
let timer = 0;
let timerInterval = null;
let currentDifficulty = 'easy';

const board = document.getElementById('memory-board');
const movesDisplay = document.getElementById('moves');
const pairsDisplay = document.getElementById('pairs');
const scoreDisplay = document.getElementById('score');
const timerDisplay = document.getElementById('timer');
const bestScoreDisplay = document.getElementById('best-score');
const messageDisplay = document.getElementById('game-message');
const difficultySelect = document.getElementById('difficulty');

function shuffle(array) {
    return array.sort(() => Math.random() - 0.5);
}

function getBestScoreKey() {
    return `memory_best_score_${currentDifficulty}`;
}

function loadBestScore() {
    const bestScore = localStorage.getItem(getBestScoreKey());
    bestScoreDisplay.textContent = bestScore ?? 'Sin registro';
}

function saveBestScore() {
    const key = getBestScoreKey();
    const bestScore = localStorage.getItem(key);

    if (!bestScore || score > Number(bestScore)) {
        localStorage.setItem(key, score);
        bestScoreDisplay.textContent = score;
    }
}

function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;

    return String(minutes).padStart(2, '0') + ':' + String(remainingSeconds).padStart(2, '0');
}

function startTimer() {
    if (timerInterval) {
        return;
    }

    timerInterval = setInterval(() => {
        timer++;
        timerDisplay.textContent = formatTime(timer);
    }, 1000);
}

function stopTimer() {
    clearInterval(timerInterval);
    timerInterval = null;
}

function resetStats() {
    firstCard = null;
    secondCard = null;
    lockBoard = false;
    moves = 0;
    matchedPairs = 0;
    score = 0;
    timer = 0;

    stopTimer();

    movesDisplay.textContent = moves;
    pairsDisplay.textContent = `${matchedPairs}/${totalPairs}`;
    scoreDisplay.textContent = score;
    timerDisplay.textContent = formatTime(timer);
    messageDisplay.textContent = 'Selecciona dos cartas para encontrar una pareja.';
}

function calculateScore() {
    const baseScore = totalPairs * 100;
    const movePenalty = moves * 5;
    const timePenalty = timer * 2;

    return Math.max(baseScore - movePenalty - timePenalty, 10);
}

function createCard(symbol, index) {
    const card = document.createElement('button');

    card.className = 'memory-card';
    card.type = 'button';
    card.dataset.symbol = symbol;
    card.dataset.index = index;
    card.textContent = '?';

    card.addEventListener('click', () => flipCard(card));

    return card;
}

function createBoard() {
    currentDifficulty = difficultySelect.value;
    totalPairs = difficultyPairs[currentDifficulty];

    const selectedSymbols = symbols.slice(0, totalPairs);
    cards = shuffle([...selectedSymbols, ...selectedSymbols]);

    board.innerHTML = '';
    board.className = `memory-board ${currentDifficulty}`;

    cards.forEach((symbol, index) => {
        board.appendChild(createCard(symbol, index));
    });

    resetStats();
    loadBestScore();
}

function flipCard(card) {
    if (lockBoard) {
        return;
    }

    if (card.classList.contains('flipped') || card.classList.contains('matched')) {
        return;
    }

    startTimer();

    card.classList.add('flipped');
    card.textContent = card.dataset.symbol;

    if (!firstCard) {
        firstCard = card;
        return;
    }

    secondCard = card;
    moves++;
    movesDisplay.textContent = moves;

    checkMatch();
}

function checkMatch() {
    const isMatch = firstCard.dataset.symbol === secondCard.dataset.symbol;

    if (isMatch) {
        markAsMatched();
        return;
    }

    hideCards();
}

function markAsMatched() {
    firstCard.classList.add('matched');
    secondCard.classList.add('matched');

    matchedPairs++;
    pairsDisplay.textContent = `${matchedPairs}/${totalPairs}`;

    resetSelection();

    if (matchedPairs === totalPairs) {
        finishGame();
    }
}

function hideCards() {
    lockBoard = true;

    setTimeout(() => {
        firstCard.classList.remove('flipped');
        secondCard.classList.remove('flipped');

        firstCard.textContent = '?';
        secondCard.textContent = '?';

        resetSelection();
    }, 800);
}

function resetSelection() {
    firstCard = null;
    secondCard = null;
    lockBoard = false;
}

function finishGame() {
    stopTimer();

    score = calculateScore();
    scoreDisplay.textContent = score;

    saveBestScore();

    messageDisplay.textContent = `Juego terminado. Puntaje final: ${score}.`;
}

difficultySelect.addEventListener('change', createBoard);

document.getElementById('restart-game').addEventListener('click', createBoard);

createBoard();
