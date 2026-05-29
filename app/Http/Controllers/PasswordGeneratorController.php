<?php

namespace App\Http\Controllers;

class PasswordGeneratorController extends Controller
{
    public function index()
    {
        return view('passwords.index');
    }

    public function generate()
    {
        return view('passwords.index');
    }
}
