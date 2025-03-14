@extends('layouts.app')

@section('content')
    <h1>{{ $driver->name }}</h1>

    <p>CNH: {{ $driver->cnh }}</p>
    <p>Data de nascimento: {{ $driver->getBirthDate() }}</p>
    <p>Idade: {{ $driver->getAge() }}</p>

    @if($driver->status === 'available')
        <p>Status: <i style="color: green" class="fa-solid fa-circle"></i> {{ $driver->status_text }}</p>
    @else
        <p>Status: <i style="color: red" class="fa-solid fa-circle"></i> {{ $driver->status_text }}</p>
    @endif
@endsection
