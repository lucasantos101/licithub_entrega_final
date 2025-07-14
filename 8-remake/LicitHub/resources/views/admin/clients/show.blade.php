@extends("layouts.admin")

@section("content")

<div class="container">
    @if(auth()->user()->user_type === 'customer')
        <div class="alert alert-danger mt-4">
            Você não tem permissão para acessar esta página.
        </div>
    @else
        <h1>Detalhes do Cliente: {{ $client->name }}</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $client->id }}</p>
                <p><strong>Nome:</strong> {{ $client->name }}</p>
                <p><strong>Email:</strong> {{ $client->email }}</p>
                <p><strong>Tipo:</strong> {{ $client->user_type }}</p>
                <p><strong>Data de Cadastro:</strong> {{ $client->created_at->format("d/m/Y H:i") }}</p>
                <p><strong>Última Atualização:</strong> {{ $client->updated_at->format("d/m/Y H:i") }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('clients.edit', $client) }}" class="btn btn-primary">Editar</a>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">Voltar para Lista</a>
                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection