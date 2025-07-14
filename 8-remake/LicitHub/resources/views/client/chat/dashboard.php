@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat com Suporte</div>
                <div class="card-body chat-container" style="height: 400px; overflow-y: auto;">
                    @if ($admin)
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
                            Não há administradores disponíveis no momento.
                        </div>
                    @endif
                </div>
                @if ($admin)
                <div class="card-footer">
                    <form action="{{ route('client.chat.send') }}" method="POST">
                        @csrf
                        <input type="hidden" name="to_user_id" value="{{ $admin->id }}">
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
