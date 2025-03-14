@extends('layouts.app')

@section('content')
    <div class="title_box">
        <h1 class="content_title"><i class="fa-solid fa-id-card"></i> Motoristas</h1>
        <a class="link_new" href="{{ route('drivers.create') }}"><i class="fa-solid fa-plus"></i> Novo Motorista</a>
    </div>

    @if(session('success'))
        <p class="msg_success">{{ session('success') }}</p>
    @endif

    @if($drivers->isEmpty())
        <p class="is_empty">Nenhum motorista cadastrado</p>
    @else
        @foreach($drivers as $driver)
            <div class="list_box">
                <div>
                    <h2 class="list_title">{{ $driver->name }}</h2>
                    <p>Idade:{{ $driver->getAge() }}</p>
                    <p>CNH: {{ $driver->cnh }}</p>
                    <p>Status: {{ $driver->status_text }}</p>
                </div>

                <div class="actions_box">
                    <div>
                        <a href="{{ route('drivers.show', $driver) }}" title="Visualizar">
                            <i class="fa-solid fa-eye"></i> Mais detalhes
                        </a>
                    </div>

                    <div>
                        <a href="{{ route('drivers.edit', $driver) }}">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                    </div>

                    <div>
                        <form
                            action="{{ route('drivers.destroy', $driver->id) }}"
                            method="POST"
                            onsubmit="return confirm('Tem certeza que deseja excluir este motorista?');"
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
        @endforeach
    @endif
@endsection
