@extends('layouts.app')

@section('content')
    <h1 class="content_title"><i class="fa-solid fa-list"></i> Detalhes da viagem</h1>

    <div class="show_list">
        <p><strong>Veículo:</strong> {{ $trip->vehicle->model }} - {{ $trip->vehicle->license_plate }}</p>
        <p><strong>Motoristas:</strong> {{ implode(', ', $trip->drivers->pluck('name')->toArray()) }}</p>
        <p><strong>Km inicial:</strong> {{ $trip->km_start }}</p>
        <p><strong>Km final:</strong> {{ $trip->km_end ?? 'Em viagem' }}</p>
        <p><strong>Data de início:</strong> {{ $trip->date_start_formatted }}</p>
        <p><strong>Data final:</strong> {{ $trip->date_end_formatted ?? 'Em viagem' }}</p>
        <p><strong>Status:</strong> {{ $trip->status_text }}</p>
    </div>

    <a class="link_back" href="{{ route('trips.index') }}">Voltar para lista</a>
@endsection
