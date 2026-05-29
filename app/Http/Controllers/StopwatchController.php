<?php

namespace App\Http\Controllers;

class StopwatchController extends Controller
{
    public function index()
    {
        return view('stopwatch.index');
    }
}
