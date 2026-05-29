<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('date')) {
            $query->whereDate('event_date', $request->date);
        }

        $events = $query
            ->orderBy('event_date')
            ->orderBy('event_time')
            ->get();

        $upcomingEvents = Event::query()
            ->whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->orderBy('event_time')
            ->limit(5)
            ->get();

        return view('events.index', compact('events', 'upcomingEvents'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'event_time' => ['nullable'],
            'reminder_at' => ['nullable', 'date'],
        ]);

        Event::create($validated);

        return redirect()
            ->route('events.index')
            ->with('success', 'Evento creado correctamente.');
    }

    public function show(Event $event)
    {
        return redirect()->route('events.index');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'event_time' => ['nullable'],
            'reminder_at' => ['nullable', 'date'],
        ]);

        $event->update($validated);

        return redirect()
            ->route('events.index')
            ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
}
