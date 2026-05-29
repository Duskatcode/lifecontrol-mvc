@extends('layouts.app')

@section('title', 'Tareas')

@section('content')
    <h1>Lista de tareas</h1>

    @if (session('success'))
        <div class="card" style="border-left: 5px solid #16a34a;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <a class="btn" href="{{ route('tasks.create') }}">Crear tarea</a>
    </div>

    <div class="card">
        @if ($tasks->isEmpty())
            <p>No hay tareas registradas.</p>
        @else
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="text-align: left; border-bottom: 1px solid #ddd; padding: 10px;">Título</th>
                        <th style="text-align: left; border-bottom: 1px solid #ddd; padding: 10px;">Descripción</th>
                        <th style="text-align: left; border-bottom: 1px solid #ddd; padding: 10px;">Estado</th>
                        <th style="text-align: left; border-bottom: 1px solid #ddd; padding: 10px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td style="padding: 10px;">{{ $task->title }}</td>
                            <td style="padding: 10px;">{{ $task->description ?? 'Sin descripción' }}</td>
                            <td style="padding: 10px;">
                                {{ $task->is_completed ? 'Completada' : 'Pendiente' }}
                            </td>
                            <td style="padding: 10px;">
                                <form method="POST" action="{{ route('tasks.toggle', $task) }}" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn" type="submit">
                                        {{ $task->is_completed ? 'Marcar pendiente' : 'Completar' }}
                                    </button>
                                </form>

                                <a class="btn" href="{{ route('tasks.edit', $task) }}">Editar</a>

                                <form method="POST" action="{{ route('tasks.destroy', $task) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit" onclick="return confirm('¿Eliminar esta tarea?')">
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
