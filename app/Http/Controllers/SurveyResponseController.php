<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyResponseController extends Controller
{
    public function create(Survey $survey)
    {
        $survey->load('questions.options');

        if ($survey->questions->isEmpty()) {
            return redirect()
                ->route('surveys.show', $survey)
                ->with('success', 'La encuesta necesita preguntas antes de responderse.');
        }

        return view('surveys.respond', compact('survey'));
    }

    public function store(Request $request, Survey $survey)
    {
        $survey->load('questions.options');

        $rules = [
            'respondent_name' => ['nullable', 'string', 'max:255'],
            'answers' => ['required', 'array'],
        ];

        foreach ($survey->questions as $question) {
            $rules["answers.{$question->id}"] = ['required', 'integer', 'exists:survey_options,id'];
        }

        $validated = $request->validate($rules);

        foreach ($survey->questions as $question) {
            $optionId = (int) $validated['answers'][$question->id];

            if (! $question->options->contains('id', $optionId)) {
                return back()
                    ->withErrors(['answers' => 'Una de las respuestas no pertenece a la pregunta correspondiente.'])
                    ->withInput();
            }
        }

        DB::transaction(function () use ($survey, $validated) {
            foreach ($survey->questions as $question) {
                $survey->responses()->create([
                    'survey_question_id' => $question->id,
                    'survey_option_id' => $validated['answers'][$question->id],
                    'respondent_name' => $validated['respondent_name'] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('surveys.results', $survey)
            ->with('success', 'Respuesta registrada correctamente.');
    }

    public function results(Survey $survey)
    {
        $survey->load('questions.options.responses');

        return view('surveys.results', compact('survey'));
    }
}
