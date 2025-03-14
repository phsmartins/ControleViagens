@extends('layouts.app')

@section('content')
    <h1>Viagens em andamento</h1>

    @if($trips->isEmpty())
        <p>Nenhuma viagem em andamento.</p>
    @else
        @foreach($trips as $trip)
            <p>{{ $trip->vehicle->model }} - {{ $trip->vehicle->license_plate }}</p>
            <p>Motoristas: {{ implode(', ', $trip->drivers->pluck('name')->toArray()) }}</p>
            <p>{{ $trip->date_start_formatted }}</p>
            <p>{{ $trip->status_text }}</p>
            <a href="{{ route('trips.show', $trip) }}" title="Visualizar">
                <i class="fa-solid fa-eye"></i>
            </a>
            <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" title="Deletar">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
            <a href="{{ route('trips.finish', $trip) }}">Finalizar</a>
            <hr>
        @endforeach
    @endif
@endsection
