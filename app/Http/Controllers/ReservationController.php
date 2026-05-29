<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::query()
            ->orderBy('reservation_date')
            ->orderBy('reservation_time')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'service' => ['required', 'string', 'max:255'],
            'reservation_date' => ['required', 'date'],
            'reservation_time' => [
                'required',
                Rule::unique('reservations')
                    ->where('reservation_date', $request->reservation_date),
            ],
            'status' => ['required', Rule::in(['pendiente', 'confirmada', 'cancelada'])],
        ]);

        Reservation::create($validated);

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reserva creada correctamente.');
    }

    public function show(Reservation $reservation)
    {
        return redirect()->route('reservations.index');
    }

    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'service' => ['required', 'string', 'max:255'],
            'reservation_date' => ['required', 'date'],
            'reservation_time' => [
                'required',
                Rule::unique('reservations')
                    ->where('reservation_date', $request->reservation_date)
                    ->ignore($reservation->id),
            ],
            'status' => ['required', Rule::in(['pendiente', 'confirmada', 'cancelada'])],
        ]);

        $reservation->update($validated);

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reserva actualizada correctamente.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reserva eliminada correctamente.');
    }
}
