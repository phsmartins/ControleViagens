@extends('layouts.app')

@section('content')
    <h1><i class="fa-solid fa-list"></i> Detalhes da viagem</h1>

    <p>Veículo: {{ $trip->vehicle->model }} - {{ $trip->vehicle->license_plate }}</p>
    <p>Motoristas: {{ implode(', ', $trip->drivers->pluck('name')->toArray()) }}</p>
    <p>Km inicial: {{ $trip->km_start }}</p>
    <p>Km final: {{ $trip->km_end ?? 'Em viagem' }}</p>
    <p>Data de início: {{ $trip->date_start_formatted }}</p>
    <p>Data final: {{ $trip->date_end_formatted ?? 'Em viagem' }}</p>
    <p>Status: {{ $trip->status_text }}</p>

    <a href="{{ route('trips.index') }}">Voltar para lista</a>
@endsection
