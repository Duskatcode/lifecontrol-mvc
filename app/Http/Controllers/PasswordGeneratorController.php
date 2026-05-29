<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordGeneratorController extends Controller
{
    public function index()
    {
        return view('passwords.index');
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'length' => ['required', 'integer', 'min:6', 'max:64'],
            'include_uppercase' => ['sometimes', 'boolean'],
            'include_lowercase' => ['sometimes', 'boolean'],
            'include_numbers' => ['sometimes', 'boolean'],
            'include_symbols' => ['sometimes', 'boolean'],
        ]);

        $length = (int) $validated['length'];

        $groups = [];

        if ($request->boolean('include_uppercase')) {
            $groups[] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }

        if ($request->boolean('include_lowercase')) {
            $groups[] = 'abcdefghijklmnopqrstuvwxyz';
        }

        if ($request->boolean('include_numbers')) {
            $groups[] = '0123456789';
        }

        if ($request->boolean('include_symbols')) {
            $groups[] = '!@#$%^&*()-_=+[]{};:,.<>?';
        }

        if (empty($groups)) {
            return back()
                ->withErrors(['characters' => 'Debes seleccionar al menos un tipo de carácter.'])
                ->withInput();
        }

        $pool = implode('', $groups);
        $password = '';

        foreach ($groups as $group) {
            $password .= $group[random_int(0, strlen($group) - 1)];
        }

        while (strlen($password) < $length) {
            $password .= $pool[random_int(0, strlen($pool) - 1)];
        }

        $password = str_shuffle($password);

        return view('passwords.index', [
            'password' => $password,
            'length' => $length,
            'includeUppercase' => $request->boolean('include_uppercase'),
            'includeLowercase' => $request->boolean('include_lowercase'),
            'includeNumbers' => $request->boolean('include_numbers'),
            'includeSymbols' => $request->boolean('include_symbols'),
        ]);
    }
}
