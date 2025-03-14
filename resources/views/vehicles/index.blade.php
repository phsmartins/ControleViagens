@extends('layouts.app')

@section('content')
    <h1><i class="fa-solid fa-bus"></i> Veículos</h1>
    <a href="{{ route('vehicles.create') }}"><i class="fa-solid fa-plus"></i> Novo Veículo</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($vehicles->isEmpty())
        <p>Nenhum veículo cadastrado</p>
    @else
        <table>
            <tr>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Placa</th>
                <th>Ações</th>
            </tr>
            @foreach($vehicles as $vehicle)
                <tr>
                    <td><a href="{{ route('vehicles.show', $vehicle->id) }}">{{ $vehicle->model }}</a></td>
                    <td>{{ $vehicle->year }}</td>
                    <td>{{ $vehicle->license_plate }}</td>
                    <td>
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Deletar"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <a href="{{ route('vehicles.show', $vehicle->id) }}" title="Visualizar">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
