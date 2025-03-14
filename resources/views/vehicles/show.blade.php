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
@endsection
