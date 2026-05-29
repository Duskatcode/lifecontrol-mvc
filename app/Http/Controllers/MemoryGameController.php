<?php

namespace App\Http\Controllers;

class MemoryGameController extends Controller
{
    public function index()
    {
        return view('memory.index');
    }
}
