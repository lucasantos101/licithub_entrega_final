@extends("layouts.admin")

@section("content")

<div class="container">
    @if(auth()->user()->user_type === 'customer')
        <div class="alert alert-danger mt-4">
            Você não tem permissão para acessar esta página.
        </div>
    @else
        <h1>Detalhes do Admin: {{ $admin->name }}</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $admin->id }}</p>
                <p><strong>Nome:</strong> {{ $admin->name }}</p>
                <p><strong>Email:</strong> {{ $admin->email }}</p>
                <p><strong>Tipo:</strong> {{ $admin->user_type }}</p>
                <p><strong>Data de Cadastro:</strong> {{ $admin->created_at->format("d/m/Y H:i") }}</p>
                <p><strong>Última Atualização:</strong> {{ $admin->updated_at->format("d/m/Y H:i") }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('admins.edit', $admin) }}" class="btn btn-primary">Editar</a>
                <a href="{{ route('admins.index') }}" class="btn btn-secondary">Voltar para Lista</a>
                <form action="{{ route('admins.destroy', $admin) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection