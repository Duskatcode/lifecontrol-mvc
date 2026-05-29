@extends('layouts.app')

@section('title', 'Gastos')

@section('content')
    <h1>Gestor de gastos</h1>

    @if (session('success'))
        <div class="card" style="border-left: 5px solid #16a34a;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <a class="btn" href="{{ route('expenses.create') }}">Registrar gasto</a>
    </div>

    <div class="card">
        <form method="GET" action="{{ route('expenses.index') }}">
            <select name="month" style="padding: 10px;">
                <option value="">Todos los meses</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" @selected(request('month') == $m)>
                        Mes {{ $m }}
                    </option>
                @endfor
            </select>

            <input
                type="number"
                name="year"
                placeholder="Año"
                value="{{ request('year') }}"
                style="padding: 10px;"
            >

            <select name="category" style="padding: 10px;">
                <option value="">Todas las categorías</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>
                        {{ $category }}
                    </option>
                @endforeach
            </select>

            <button class="btn" type="submit">Filtrar</button>
            <a class="btn" href="{{ route('expenses.index') }}">Limpiar</a>
        </form>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Total filtrado</h3>
            <p style="font-size: 28px; font-weight: bold;">
                ${{ number_format($total, 2) }}
            </p>
        </div>

        <div class="card">
            <h3>Total por categoría</h3>
            @forelse ($totalsByCategory as $category => $categoryTotal)
                <p><strong>{{ $category }}:</strong> ${{ number_format($categoryTotal, 2) }}</p>
            @empty
                <p>No hay datos.</p>
            @endforelse
        </div>
    </div>

    <div class="card">
        @if ($expenses->isEmpty())
            <p>No hay gastos registrados.</p>
        @else
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Fecha</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Categoría</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Descripción</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Monto</th>
                        <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr>
                            <td style="padding: 10px;">{{ $expense->expense_date->format('Y-m-d') }}</td>
                            <td style="padding: 10px;">{{ $expense->category }}</td>
                            <td style="padding: 10px;">{{ $expense->description ?: 'Sin descripción' }}</td>
                            <td style="padding: 10px;">${{ number_format($expense->amount, 2) }}</td>
                            <td style="padding: 10px;">
                                <a class="btn" href="{{ route('expenses.edit', $expense) }}">Editar</a>

                                <form method="POST" action="{{ route('expenses.destroy', $expense) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit" onclick="return confirm('¿Eliminar este gasto?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
