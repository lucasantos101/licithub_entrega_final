@extends("layouts.admin")

@section("content")
<div class="container">
    @if(auth()->user()->user_type === 'customer')
        <div class="alert alert-danger mt-4">
            Você não tem permissão para acessar esta página.
        </div>
    @else
        <h1>Editar Cliente: {{ $client->name }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clients.update', $client) }}" method="POST">
            @csrf
            @method("PUT")

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $client->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $client->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="user_type" class="form-label">Tipo de Usuário</label>
                <select class="form-control" id="user_type" name="user_type" required>
                    <option value="customer" {{ old('user_type', $client->user_type) === 'customer' ? 'selected' : '' }}>Cliente</option>
                    <option value="admin" {{ old('user_type', $client->user_type) === 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <hr>
            <p style="color:red">Deixe os campos de senha em branco para não alterar a senha atual.</p>

            <div class="mb-3">
                <label for="password" class="form-label">Nova Senha</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    @endif
</div>
@endsection