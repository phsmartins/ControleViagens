@extends('layouts.app')

@section('content')
    <h1>Viagens em aberto</h1>

    @php
        $ongoingTrips = $trips->where('status', 'ongoing');
    @endphp

    @if($ongoingTrips->isNotEmpty())
        <table>
            <thead>
            <tr>
                <th>Veículo</th>
                <th>Motoristas</th>
                <th>Data da viagem</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ongoingTrips as $trip)
                <tr>
                    <td>{{ $trip->vehicle->model }} ({{ $trip->vehicle->license_plate }})</td>
                    <td>{{ implode(', ', $trip->drivers->pluck('name')->toArray()) }}</td>
                    <td>{{ $trip->date_start }}</td>
                    <td>{{ $trip->status }}</td>
                    <td>
                        <a href="{{ route('trips.show', $trip) }}" title="Visualizar"><i class="fa-solid fa-eye"></i></a>
                        <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Deletar"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <a href="{{ route('trips.edit-ongoing', $trip) }}">Editar</a>
                        <a href="{{ route('trips.finish', $trip) }}">Finalizar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Não há viagens em aberto</p>
    @endif

    <h1>Viagens finalizadas</h1>

    @php
        $completedTrips = $trips->where('status', 'completed');
    @endphp

    @if($completedTrips->isNotEmpty())
        <table>
            <thead>
            <tr>
                <th>Veículo</th>
                <th>Motoristas</th>
                <th>Data da viagem</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($completedTrips as $trip)
                <tr>
                    <td>{{ $trip->vehicle->model }} ({{ $trip->vehicle->license_plate }})</td>
                    <td>{{ implode(', ', $trip->drivers->pluck('name')->toArray()) }}</td>
                    <td>{{ $trip->date_start }}</td>
                    <td>{{ $trip->status }}</td>
                    <td>
                        <a href="{{ route('trips.show', $trip) }}" title="Visualizar"><i class="fa-solid fa-eye"></i></a>
                        <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Deletar"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <a href="{{ route('trips.edit-completed', $trip) }}">Editar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Não há viagens finalizadas</p>
    @endif
@endsection
