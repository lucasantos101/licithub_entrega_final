@extends("layouts.admin")

@section("content")
<div class="container">
    @if(auth()->user()->user_type === 'customer')
        <div class="alert alert-danger mt-4">
            Você não tem permissão para acessar esta página.
        </div>
    @else
        <h1>Adicionar Novo Admin</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admins.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="user_type" class="form-label">Tipo de Usuário</label>
                <select class="form-control" id="user_type" name="user_type" required>
                    <option value="customer" {{ old('user_type') == 'customer' ? 'selected' : '' }}>Cliente</option>
                    <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Admin</button>
            <a href="{{ route('admins.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    @endif
</div>
@endsection