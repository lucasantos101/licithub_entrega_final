@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">Suporte Administrativo Disponíveis</div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($admins as $admin)
                            <li class="list-group-item {{ $selectedAdmin && $selectedAdmin->id == $admin->id ? 'active bg-light' : '' }}">
                                <a href="{{ route('client.chat', ['admin_id' => $admin->id]) }}" class="d-flex justify-content-between align-items-center text-decoration-none text-dark">
                                    {{ $admin->name }}

                                    <span class="badge bg-light text-dark">
                            
                                                            @if($admin->isOnline())                              
                                                                <span style="color:green">
                                                                    On
                                                                </span>
                                                            @else
                                                                <span  style="color:gray">
                                                                    Off
                                                                </span>
                                                            @endif
                                    </span>

                                    @if($admin->unread_count > 0)
                                        <span class="badge bg-primary rounded-pill">{{ $admin->unread_count }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    @if($selectedAdmin)
                        Chat com {{ $selectedAdmin->name }} <span class="badge bg-light text-dark">
                            
                                                            @if($selectedAdmin->isOnline())                              
                                                                <span style="color:green">
                                                                    On
                                                                </span>
                                                            @else
                                                                <span  style="color:gray">
                                                                    Off
                                                                </span>
                                                            @endif
                                    </span>
                    @else
                        Selecione um administrador para iniciar o chat
                    @endif
                </div>
                <div class="card-body p-0">
                    @if($selectedAdmin)
                        <div class="chat-messages p-3" id="chat-messages" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
                            @foreach($messages as $message)
                                <div class="message mb-3 {{ $message->from_user_id == Auth::id() ? 'text-end' : 'text-start' }}">
                                    <div class="message-content p-3 d-inline-block {{ $message->from_user_id == Auth::id() ? 'bg-primary text-white' : 'bg-white border' }}" style="border-radius: 15px; max-width: 80%; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
                                        <div class="message-text">{{ $message->message }}</div>
                                        <div class="message-time small mt-1 {{ $message->from_user_id == Auth::id() ? 'text-white-50' : 'text-muted' }}">
                                            {{ $message->created_at->format('H:i') }}
                                            @if($message->from_user_id == Auth::id() && $message->is_read)
                                                <i class="fas fa-check-double ms-1"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <form action="{{ route('client.chat.send') }}" method="POST" class="p-3 border-top">
                            @csrf
                            <input type="hidden" name="to_user_id" value="{{ $selectedAdmin->id }}">
                            <div class="input-group">
                                <input type="text" name="message" class="form-control rounded-start" placeholder="Digite sua mensagem..." required>
                                <button type="submit" class="btn btn-primary rounded-end">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="text-center p-5">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Selecione um administrador para iniciar o chat.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($selectedAdmin)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Obter o ID do usuário autenticado do PHP para JS
        const authUserId = {{ Auth::id() }};

        // Configurar polling para novas mensagens
        let lastMessageId = {{ $messages->count() ? $messages->last()->id : 0 }};
        let isPollingActive = true;
        
        function loadNewMessages() {
            if (!isPollingActive) return;
            
            fetch(`{{ route('client.chat.new-messages') }}?admin_id={{ $selectedAdmin->id }}&last_message_id=${lastMessageId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.messages && data.messages.length > 0) {
                    // Filtrar apenas mensagens realmente novas (id > lastMessageId)
                    const newMessages = data.messages.filter(msg => msg.id > lastMessageId);
                    
                    if (newMessages.length > 0) {
                        newMessages.forEach(message => {
                            const messageDiv = document.createElement('div');
                            messageDiv.className = `message mb-3 ${message.from_user_id == authUserId ? 'text-end' : 'text-start'}`;
                            
                            const messageContent = document.createElement('div');
                            messageContent.className = `message-content p-3 d-inline-block ${message.from_user_id == authUserId ? 'bg-primary text-white' : 'bg-white border'}`;
                            messageContent.style.borderRadius = '15px';
                            messageContent.style.maxWidth = '80%';
                            messageContent.style.boxShadow = '0 1px 2px rgba(0,0,0,0.1)';
                            
                            const messageText = document.createElement('div');
                            messageText.className = 'message-text';
                            messageText.textContent = message.message;
                            
                            const messageTime = document.createElement('div');
                            messageTime.className = `message-time small mt-1 ${message.from_user_id == authUserId ? 'text-white-50' : 'text-muted'}`;
                            
                            // Formatar a data
                            const date = new Date(message.created_at);
                            const hours = date.getHours().toString().padStart(2, '0');
                            const minutes = date.getMinutes().toString().padStart(2, '0');
                            messageTime.textContent = `${hours}:${minutes}`;
                            
                            if (message.from_user_id == authUserId && message.is_read) {
                                const checkIcon = document.createElement('i');
                                checkIcon.className = 'fas fa-check-double ms-1';
                                messageTime.appendChild(checkIcon);
                            }
                            
                            messageContent.appendChild(messageText);
                            messageContent.appendChild(messageTime);
                            messageDiv.appendChild(messageContent);
                            chatMessages.appendChild(messageDiv);
                        });
                        
                        // Atualizar o último ID de mensagem apenas com as novas mensagens
                        lastMessageId = newMessages[newMessages.length - 1].id;
                        
                        // Rolar para o final
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }
                }
            })
            .catch(error => console.error('Error fetching new messages:', error))
            .finally(() => {
                if (isPollingActive) {
                    setTimeout(loadNewMessages, 5000); // Verificar novamente após 5 segundos
                }
            });
        }
        
        // Iniciar o polling
        loadNewMessages();
        
        // Parar o polling quando a página for descarregada
        window.addEventListener('beforeunload', function() {
            isPollingActive = false;
        });

        // Enviar mensagem com Enter
        document.querySelector('form').addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.querySelector('button[type="submit"]').click();
            }
        });
    });
</script>

<style>
    .message-content {
        transition: all 0.3s ease;
    }
    .message-content:hover {
        box-shadow: 0 2px 5px rgba(0,0,0,0.1) !important;
    }
    .chat-messages::-webkit-scrollbar {
        width: 8px;
    }
    .chat-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .chat-messages::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }
    .chat-messages::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>
@endif
@endsection