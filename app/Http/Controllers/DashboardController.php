<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Expense;
use App\Models\Note;
use App\Models\Recipe;
use App\Models\Reservation;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $taskStats = [
            'total' => Task::count(),
            'pending' => Task::where('is_completed', false)->count(),
            'completed' => Task::where('is_completed', true)->count(),
        ];

        $expenseStats = [
            'current_month_total' => Expense::query()
                ->whereMonth('expense_date', $currentMonth)
                ->whereYear('expense_date', $currentYear)
                ->sum('amount'),

            'total' => Expense::sum('amount'),
            'count' => Expense::count(),
        ];

        $reservationStats = [
            'total' => Reservation::count(),
            'pending' => Reservation::where('status', 'pendiente')->count(),
            'confirmed' => Reservation::where('status', 'confirmada')->count(),
            'cancelled' => Reservation::where('status', 'cancelada')->count(),
        ];

        $contentStats = [
            'notes' => Note::count(),
            'recipes' => Recipe::count(),
        ];

        $eventStats = [
            'total' => Event::count(),
            'upcoming' => Event::whereDate('event_date', '>=', now()->toDateString())->count(),
        ];

        $surveyStats = [
            'surveys' => Survey::count(),
            'questions' => SurveyQuestion::count(),
            'responses' => SurveyResponse::count(),
        ];

        $latestTasks = Task::latest()->limit(5)->get();

        $latestNotes = Note::latest()->limit(4)->get();

        $upcomingReservations = Reservation::query()
            ->whereDate('reservation_date', '>=', now()->toDateString())
            ->orderBy('reservation_date')
            ->orderBy('reservation_time')
            ->limit(5)
            ->get();

        $upcomingEvents = Event::query()
            ->whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->orderBy('event_time')
            ->limit(5)
            ->get();

        $latestSurveys = Survey::query()
            ->withCount(['questions', 'responses'])
            ->latest()
            ->limit(4)
            ->get();

        return view('dashboard', compact(
            'taskStats',
            'expenseStats',
            'reservationStats',
            'contentStats',
            'eventStats',
            'surveyStats',
            'latestTasks',
            'latestNotes',
            'upcomingReservations',
            'upcomingEvents',
            'latestSurveys'
        ));
    }
}
