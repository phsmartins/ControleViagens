@extends('layouts.app')

@section('content')
    <h1>{{ $vehicle->model }} - {{ $vehicle->license_plate }}</h1>

    <p>Ano: {{ $vehicle->year }}</p>
    <p>Data de aquisição: {{ $vehicle->getAcquisitionDate() }}</p>
    <p>Km na aquisição: {{ $vehicle->km_at_acquisition_formatted  }}</p>
    <p>Renavam: {{ $vehicle->renavam }}</p>

    @if($vehicle->status === 'available')
        <p>Status: <i style="color: green" class="fa-solid fa-circle"></i> {{ $vehicle->status_text }}</p>
    @else
        <p>Status: <i style="color: red" class="fa-solid fa-circle"></i> {{ $vehicle->status_text }}</p>
    @endif

    <hr>

    <h2>Histórico de Viagens</h2>

    @if ($vehicle->trips->isEmpty())
        <p>Este veículo ainda não participou de nenhuma viagem</p>
    @else
        @foreach ($vehicle->trips as $trip)
            <div>
                <p>Motoristas: {{ implode(', ', $trip->drivers->pluck('name')->toArray()) }}</p>
                <p>Data da viagem: {{ $trip->date_start_formatted }}</p>
                <p>Status: {{ $trip->status_text }}</p>
                <a href="{{ route('trips.show', $trip) }}" title="Ver Detalhes">Mais detalhes</a>
                <hr>
            </div>
        @endforeach
    @endif
@endsection
