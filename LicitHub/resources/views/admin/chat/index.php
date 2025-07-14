@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Clientes</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($clients as $client)
                        <li class="list-group-item {{ $selectedClient && $selectedClient->id == $client->id ? 'active' : '' }}">
                            <a href="{{ route('admin.chat', ['client_id' => $client->id]) }}" class="text-decoration-none {{ $selectedClient && $selectedClient->id == $client->id ? 'text-white' : '' }}">
                                {{ $client->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Chat {{ $selectedClient ? 'com ' . $selectedClient->name : '' }}
                </div>
                <div class="card-body chat-container" style="height: 400px; overflow-y: auto;">
                    @if ($selectedClient)
                        @foreach ($messages as $message)
                            <div class="mb-3 {{ $message->from_user_id == Auth::id() ? 'text-end' : 'text-start' }}">
                                <div class="d-inline-block p-2 rounded {{ $message->from_user_id == Auth::id() ? 'bg-primary text-white' : 'bg-light' }}" style="max-width: 80%;">
                                    {{ $message->message }}
                                    <div class="small text-muted">
                                        {{ $message->created_at->format('H:i') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted">
                            Selecione um cliente para iniciar o chat
                        </div>
                    @endif
                </div>
                @if ($selectedClient)
                <div class="card-footer">
                    <form action="{{ route('admin.chat.send') }}" method="POST">
                        @csrf
                        <input type="hidden" name="to_user_id" value="{{ $selectedClient->id }}">
                        <div class="input-group">
                            <input type="text" name="message" class="form-control" placeholder="Digite sua mensagem...">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
