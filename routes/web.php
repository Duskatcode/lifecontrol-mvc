<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TipCalculatorController;
use App\Http\Controllers\PasswordGeneratorController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\MemoryGameController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyQuestionController;
use App\Http\Controllers\SurveyResponseController;
use App\Http\Controllers\StopwatchController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])
    ->name('tasks.toggle');

Route::resource('tasks', TaskController::class);

Route::get('/tip-calculator', [TipCalculatorController::class, 'index'])
    ->name('tips.index');

Route::post('/tip-calculator', [TipCalculatorController::class, 'calculate'])
    ->name('tips.calculate');

Route::get('/password-generator', [PasswordGeneratorController::class, 'index'])
    ->name('passwords.index');

Route::post('/password-generator', [PasswordGeneratorController::class, 'generate'])
    ->name('passwords.generate');

Route::resource('expenses', ExpenseController::class);
Route::resource('reservations', ReservationController::class);
Route::resource('notes', NoteController::class);
Route::resource('events', EventController::class);
Route::resource('recipes', RecipeController::class);

Route::get('/memory-game', [MemoryGameController::class, 'index'])
    ->name('memory.index');

/*
|--------------------------------------------------------------------------
| Survey custom routes
|--------------------------------------------------------------------------
| Estas rutas deben ir ANTES de Route::resource('surveys', ...)
| para evitar conflictos con /surveys/{survey}
*/

Route::get('/surveys/{survey}/questions/create', [SurveyQuestionController::class, 'create'])
    ->name('surveys.questions.create');

Route::post('/surveys/{survey}/questions', [SurveyQuestionController::class, 'store'])
    ->name('surveys.questions.store');

Route::delete('/survey-questions/{question}', [SurveyQuestionController::class, 'destroy'])
    ->name('survey-questions.destroy');

Route::get('/surveys/{survey}/respond', [SurveyResponseController::class, 'create'])
    ->name('surveys.respond');

Route::post('/surveys/{survey}/respond', [SurveyResponseController::class, 'store'])
    ->name('surveys.responses.store');

Route::get('/surveys/{survey}/results', [SurveyResponseController::class, 'results'])
    ->name('surveys.results');

Route::resource('surveys', SurveyController::class);

Route::get('/stopwatch', [StopwatchController::class, 'index'])
    ->name('stopwatch.index');
