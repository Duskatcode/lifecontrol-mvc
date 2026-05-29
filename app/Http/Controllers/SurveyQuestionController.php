<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyQuestionController extends Controller
{
    public function create(Survey $survey)
    {
        $survey->load('questions.options');

        return view('surveys.questions.create', compact('survey'));
    }

    public function store(Request $request, Survey $survey)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'options' => ['required', 'array', 'min:2', 'max:6'],
            'options.*' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($survey, $validated) {
            $question = $survey->questions()->create([
                'question' => $validated['question'],
                'type' => 'single_choice',
            ]);

            foreach ($validated['options'] as $optionText) {
                $question->options()->create([
                    'option_text' => $optionText,
                ]);
            }
        });

        return redirect()
            ->route('surveys.questions.create', $survey)
            ->with('success', 'Pregunta agregada correctamente.');
    }

    public function destroy(SurveyQuestion $question)
    {
        $survey = $question->survey;

        $question->delete();

        return redirect()
            ->route('surveys.questions.create', $survey)
            ->with('success', 'Pregunta eliminada correctamente.');
    }
}
