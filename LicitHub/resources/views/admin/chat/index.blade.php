@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Client List Sidebar -->
        <div class="col-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Clientes Assinantes</h5>
                </div>
                <div class="card-body p-0">
                    @if($clients->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($clients as $client)
                                @if($client->user_type === 'customer' && $client->hasActiveCashierSubscription())
                                    <li class="list-group-item list-group-item-action {{ $selectedClient && $selectedClient->id == $client->id ? 'active bg-light' : '' }}">
                                        <a href="{{ route('admin.chat', ['client_id' => $client->id]) }}" class="d-flex justify-content-between align-items-center text-decoration-none text-dark">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    <i class="fas fa-user-circle fa-lg"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-bold">{{ $client->name }} </span>
                                            
                            
                                                    @if($client->isOnline())                              
                                                                <span class="badge badge-success">
                                                                    <i class="fas fa-circle"></i> Online
                                                                </span>
                                                            @else
                                                                <span class="badge badge-secondary">
                                                                <i class="fas fa-circle"></i> Offline
                                                                </span>
                                                            @endif
                        
                                                    
                                                    <div class="text-muted small">{{ $client->email }}</div>
                                                </div>
                                            </div>
                                            @if($client->unread_count > 0)
                                                <span class="badge bg-danger rounded-pill">{{ $client->unread_count }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <div class="p-3 text-center text-muted">
                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                            <p>Nenhum cliente assinante encontrado</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                    @if($selectedClient)
        <i class="fas fa-comments me-2"></i>Chat com {{ $selectedClient->name }}
    @else
        <i class="fas fa-comment-dots me-2"></i>Selecione um cliente
    @endif

    @if($selectedClient)
        <span class="ms-4 align-middle">
            @if($selectedClient->isOnline())                              
                <span class="badge bg-success">
                    <i class="fas fa-circle"></i>Online
                </span>
            @else
                <span class="badge bg-secondary">
                    <i class="fas fa-circle "></i>Offline
                </span>
            @endif
        </span>
    @endif
                </div>

                
                <div class="card-body p-0 d-flex flex-column" style="height: 500px;">
                    @if($selectedClient)
                        <!-- Messages Container -->
                        <div class="chat-messages p-3 flex-grow-1" id="chat-messages" style="overflow-y: auto; background-color: #f8f9fa;">
                            @foreach($messages as $message)
                                <div class="message mb-3 {{ $message->from_user_id == Auth::id() ? 'text-end' : 'text-start' }}">
                                    <div class="d-flex flex-column {{ $message->from_user_id == Auth::id() ? 'align-items-end' : 'align-items-start' }}">
                                        <div class="message-content p-3 d-inline-block {{ $message->from_user_id == Auth::id() ? 'bg-primary text-white' : 'bg-white border' }}" 
                                             style="border-radius: 15px; max-width: 80%; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                                            <div class="message-text">{{ $message->message }}</div>
                                            <div class="message-time small mt-2 {{ $message->from_user_id == Auth::id() ? 'text-white-50' : 'text-muted' }}">
                                                {{ $message->created_at->format('H:i') }}
                                                @if($message->from_user_id == Auth::id() && $message->is_read)
                                                    <i class="fas fa-check-double ms-1"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <small class="text-muted mt-1">
                                            @if($message->from_user_id == Auth::id())
                                                Você
                                            @else
                                                {{ $selectedClient->name }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Message Input -->
                        <form action="{{ route('admin.chat.send') }}" method="POST" class="p-3 border-top">
                            @csrf
                            <input type="hidden" name="to_user_id" value="{{ $selectedClient->id }}">
                            <div class="input-group">
                                <input type="text" name="message" class="form-control rounded-start" placeholder="Digite sua mensagem..." required>
                                <button type="submit" class="btn btn-primary rounded-end">
                                    <i class="fas fa-paper-plane"></i> Enviar
                                </button>
                            </div>
                        </form>
                    @else
                        <!-- Empty State -->
                        <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center text-muted">
                            <i class="fas fa-comment-slash fa-4x mb-3"></i>
                            <h5>Nenhum cliente selecionado</h5>
                            <p>Selecione um cliente da lista ao lado para iniciar a conversa</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($selectedClient)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // Configurar polling para novas mensagens
        let lastMessageId = {{ $messages->count() ? $messages->last()->id : 0 }};
        let isPollingActive = true;
        
        // Get the authenticated user ID from PHP
        const authUserId = {{ Auth::id() }};
        function loadNewMessages() {
            if (!isPollingActive) return;
            
            fetch(`{{ route('admin.chat.new-messages') }}?client_id={{ $selectedClient->id }}&last_message_id=${lastMessageId}`, {
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
                            
                            const messageContainer = document.createElement('div');
                            messageContainer.className = `d-flex flex-column ${message.from_user_id == authUserId ? 'align-items-end' : 'align-items-start'}`;
                            
                            const messageContent = document.createElement('div');
                            messageContent.className = `message-content p-3 d-inline-block ${message.from_user_id == authUserId ? 'bg-primary text-white' : 'bg-white border'}`;
                            messageContent.style.borderRadius = '15px';
                            messageContent.style.maxWidth = '80%';
                            messageContent.style.boxShadow = '0 1px 3px rgba(0,0,0,0.1)';
                            
                            const messageText = document.createElement('div');
                            messageText.className = 'message-text';
                            messageText.textContent = message.message;
                            
                            const messageTime = document.createElement('div');
                            messageTime.className = `message-time small mt-2 ${message.from_user_id == authUserId ? 'text-white-50' : 'text-muted'}`;
                            
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
                            
                            const senderInfo = document.createElement('small');
                            senderInfo.className = 'text-muted mt-1';
                            senderInfo.textContent = message.from_user_id == authUserId ? 'Você' : '{{ $selectedClient->name }}';
                            
                            messageContent.appendChild(messageText);
                            messageContent.appendChild(messageTime);
                            messageContainer.appendChild(messageContent);
                            messageContainer.appendChild(senderInfo);
                            messageDiv.appendChild(messageContainer);
                            chatMessages.appendChild(messageDiv);
                        });
                        
                        // Atualizar o último ID de mensagem
                        lastMessageId = newMessages[newMessages.length - 1].id;
                        
                        // Rolar para o final
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }
                }
            })
            .catch(error => console.error('Error fetching new messages:', error))
            .finally(() => {
                if (isPollingActive) {
                    setTimeout(loadNewMessages, 3000); // Verificar a cada 3 segundos
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
        document.querySelector('form')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.querySelector('button[type="submit"]').click();
            }
        });
    });
</script>

<style>
    .chat-messages {
        scroll-behavior: smooth;
    }
    .message-content {
        transition: all 0.2s ease;
    }
    .message-content:hover {
        box-shadow: 0 2px 5px rgba(0,0,0,0.1) !important;
    }
    /* Custom scrollbar */
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