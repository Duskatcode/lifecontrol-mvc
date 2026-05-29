<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        if ($request->filled('search')) {
            $search = $request->string('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('ingredients', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        $recipes = $query->latest()->get();

        $categories = Recipe::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'ingredients' => ['required', 'string'],
            'instructions' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
        ]);

        Recipe::create($validated);

        return redirect()
            ->route('recipes.index')
            ->with('success', 'Receta creada correctamente.');
    }

    public function show(Recipe $recipe)
    {
        return redirect()->route('recipes.index');
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'ingredients' => ['required', 'string'],
            'instructions' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
        ]);

        $recipe->update($validated);

        return redirect()
            ->route('recipes.index')
            ->with('success', 'Receta actualizada correctamente.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()
            ->route('recipes.index')
            ->with('success', 'Receta eliminada correctamente.');
    }
}
