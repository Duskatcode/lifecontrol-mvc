@extends('layouts.app')

@section('title', 'Editar gasto')

@section('content')
    <h1>Editar gasto</h1>

    <div class="card">
        <form method="POST" action="{{ route('expenses.update', $expense) }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 16px;">
                <label for="amount">Monto</label>
                <input id="amount" name="amount" type="number" step="0.01" min="0" value="{{ old('amount', $expense->amount) }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('amount') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="category">Categoría</label>
                <input id="category" name="category" value="{{ old('category', $expense->category) }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('category') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="description">Descripción</label>
                <input id="description" name="description" value="{{ old('description', $expense->description) }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('description') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="expense_date">Fecha</label>
                <input id="expense_date" name="expense_date" type="date" value="{{ old('expense_date', $expense->expense_date->format('Y-m-d')) }}" style="width: 100%; padding: 10px; margin-top: 6px;">
                @error('expense_date') <p style="color: #dc2626;">{{ $message }}</p> @enderror
            </div>

            <button class="btn" type="submit">Actualizar</button>
            <a class="btn" href="{{ route('expenses.index') }}">Volver</a>
        </form>
    </div>
@endsection
