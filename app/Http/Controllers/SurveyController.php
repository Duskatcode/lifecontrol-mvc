<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::query()
            ->withCount(['questions', 'responses'])
            ->latest()
            ->get();

        return view('surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $survey = Survey::create($validated);

        return redirect()
            ->route('surveys.questions.create', $survey)
            ->with('success', 'Encuesta creada. Ahora agrega preguntas.');
    }

    public function show(Survey $survey)
    {
        $survey->load('questions.options');

        return view('surveys.show', compact('survey'));
    }

    public function edit(Survey $survey)
    {
        return view('surveys.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $survey->update($validated);

        return redirect()
            ->route('surveys.index')
            ->with('success', 'Encuesta actualizada correctamente.');
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();

        return redirect()
            ->route('surveys.index')
            ->with('success', 'Encuesta eliminada correctamente.');
    }
}
