<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipCalculatorController extends Controller
{
    public function index()
    {
        return view('tips.index');
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'percentage' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $amount = (float) $validated['amount'];
        $percentage = (float) $validated['percentage'];

        $tip = $amount * ($percentage / 100);
        $total = $amount + $tip;

        return view('tips.index', [
            'amount' => $amount,
            'percentage' => $percentage,
            'tip' => $tip,
            'total' => $total,
        ]);
    }
}
