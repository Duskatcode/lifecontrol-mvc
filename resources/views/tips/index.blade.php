@extends('layouts.app')

@section('title', 'Calculadora de propinas')

@section('content')
    <h1>Calculadora de propinas</h1>

    <div class="card">
        <form method="POST" action="{{ route('tips.calculate') }}">
            @csrf

            <div style="margin-bottom: 16px;">
                <label for="amount">Monto de la cuenta</label>
                <input
                    type="number"
                    step="0.01"
                    min="0"
                    id="amount"
                    name="amount"
                    value="{{ old('amount', $amount ?? '') }}"
                    style="width: 100%; padding: 10px; margin-top: 6px;"
                >

                @error('amount')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="percentage">Porcentaje de propina</label>
                <select
                    id="percentage"
                    name="percentage"
                    style="width: 100%; padding: 10px; margin-top: 6px;"
                >
                    @php
                        $selectedPercentage = old('percentage', $percentage ?? 10);
                    @endphp

                    <option value="5" @selected($selectedPercentage == 5)>5%</option>
                    <option value="10" @selected($selectedPercentage == 10)>10%</option>
                    <option value="15" @selected($selectedPercentage == 15)>15%</option>
                    <option value="20" @selected($selectedPercentage == 20)>20%</option>
                    <option value="25" @selected($selectedPercentage == 25)>25%</option>
                </select>

                @error('percentage')
                    <p style="color: #dc2626;">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn" type="submit">Calcular propina</button>
        </form>
    </div>

    @isset($total)
        <div class="card">
            <h2>Resultado</h2>

            <p><strong>Monto base:</strong> ${{ number_format($amount, 2) }}</p>
            <p><strong>Porcentaje:</strong> {{ $percentage }}%</p>
            <p><strong>Propina:</strong> ${{ number_format($tip, 2) }}</p>
            <p><strong>Total a pagar:</strong> ${{ number_format($total, 2) }}</p>
        </div>
    @endisset
@endsection
