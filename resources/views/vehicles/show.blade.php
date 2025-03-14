@extends('layouts.app')

@section('content')
    <h1 class="content_title">{{ $vehicle->model }} - {{ $vehicle->license_plate }}</h1>

    <div class="show_list">
        <p><strong>Ano:</strong> {{ $vehicle->year }}</p>
        <p><strong>Data de aquisição:</strong> {{ $vehicle->getAcquisitionDate() }}</p>
        <p><strong>Km na aquisição:</strong> {{ $vehicle->km_at_acquisition_formatted  }}</p>
        <p><strong>Renavam:</strong> {{ $vehicle->renavam }}</p>

        @if($vehicle->status === 'available')
            <p><strong>Status:</strong> <i style="color: green" class="fa-solid fa-circle"></i> {{ $vehicle->status_text }}</p>
        @elseif($vehicle->status === 'on_trip')
            <p><strong>Status:</strong> <i style="color: red" class="fa-solid fa-circle"></i> {{ $vehicle->status_text }}</p>
        @else
            <p><strong>Status:</strong> <i class="fa-solid fa-circle"></i> {{ $vehicle->status_text }}</p>
        @endif
    </div>

    <h2 class="content_title">Histórico de Viagens</h2>

    @if ($vehicle->trips->isEmpty())
        <p class="is_empty">Este veículo ainda não participou de nenhuma viagem</p>
    @else
        @foreach ($vehicle->trips as $trip)
            <div class="show_list" style="margin-bottom: 3rem">
                <p><strong>Motoristas:</strong> {{ implode(', ', $trip->drivers->pluck('name')->toArray()) }}</p>
                <p><strong>Data da viagem:</strong> {{ $trip->date_start_formatted }}</p>
                <p><strong>Status:</strong> {{ $trip->status_text }}</p>
                <a class="more_details" href="{{ route('trips.show', $trip) }}" title="Ver Detalhes">Mais detalhes</a>
                <hr>
            </div>
        @endforeach
    @endif
@endsection
