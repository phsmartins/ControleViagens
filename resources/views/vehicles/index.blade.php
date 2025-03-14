@extends('layouts.app')

@section('content')
    <div class="title_box">
        <h1 class="content_title"><i class="fa-solid fa-bus"></i> Veículos</h1>
        <a class="link_new" href="{{ route('vehicles.create') }}"><i class="fa-solid fa-plus"></i> Novo Veículo</a>
    </div>

    @if(session('success'))
        <p class="msg_success">{{ session('success') }}</p>
    @endif

    @forelse($vehicles as $vehicle)
        <div class="list_box">
            <div>
                <h2 class="list_title">{{ $vehicle->model }} - {{ $vehicle->license_plate }}</h2>
                <p>Ano:{{ $vehicle->year }}</p>
                <p>Renavam:{{ $vehicle->renavam }}</p>
            </div>

            <div class="actions_box">
                <div>
                    <a href="{{ route('vehicles.show', $vehicle) }}" title="Visualizar">
                        <i class="fa-solid fa-eye"></i> Mais detalhes
                    </a>
                </div>

                <div>
                    <a href="{{ route('vehicles.edit', $vehicle) }}">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </a>
                </div>

                <div>
                    <form
                        action="{{ route('vehicles.destroy', $vehicle->id) }}"
                        method="POST"
                        onsubmit="return confirm('Tem certeza que deseja excluir este veículo?');"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Deletar">
                            <i class="fa-solid fa-trash"></i> Deletar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    @empty
        <p class="is_empty">Nenhum veículo cadastrado</p>
    @endforelse
@endsection
