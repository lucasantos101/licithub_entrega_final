<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Pro | Gerenciar Clientes</title>
    
    <!-- Fontes e Ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    @vite(['resources/css/admin.css'])
    <style>
        .simple-pagination {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
    gap: 4px;
    margin: 20px 0;
}

.simple-pagination li {
    margin: 0;
}

.simple-pagination li a,
.simple-pagination li span {
    display: block;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    color: var(--text-color);
    background-color: var(--card-bg);
    border: 1px solid var(--card-border);
    transition: all 0.2s ease;
}

.simple-pagination li a:hover {
    background-color: var(--sidebar-active);
    color: var(--primary);
}

.simple-pagination li.active span {
    background-color: var(--primary);
    color: white;
    border-color: var(--primary);
}

.simple-pagination li.disabled span {
    color: var(--gray-400);
    background-color: var(--card-bg);
}

/* Dark Mode */
.dark-mode .simple-pagination li a,
.dark-mode .simple-pagination li span {
    background-color: var(--sidebar-bg);
    border-color: var(--card-border);
}

.dark-mode .simple-pagination li a:hover {
    background-color: var(--sidebar-active);
}
    </style>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon.png">
    
</head>
<body class="dark-mode">
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <span class="logo-text">Licit <span class="logo-highlight">Admin</span></span>
                </div>
                <button class="sidebar-close" id="sidebar-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="sidebar-menu">
                <ul>
                    <li class="menu-title">PRINCIPAL</li>
                    <li class="menu-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="menu-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="menu-title">GERENCIAMENTO</li>
                    <li class="menu-item active">
                        <a href="{{ route('clients.index') }}">
                            <div class="menu-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="menu-text">Clientes</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admins.index') }}">
                            <div class="menu-icon">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="menu-text">Administradores</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('plans.index') }}">
                            <div class="menu-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <span class="menu-text">Planos</span>
                        </a>
                    </li>
                    <li class="menu-item">
                    <a href="{{ route('welcome') }}">
                            <div class="menu-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <span class="menu-text">Site</span>
                        </a>
                    </li>
                                        <li class="menu-item">
                        <a href="{{ route('admin.chat') }}">
                            <div class="menu-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <span class="menu-text">Chat</span>
                        </a>
                    </li>
                    <!--<li class="menu-item has-submenu">
                        <a href="#">
                            <div class="menu-icon">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <span class="menu-text">Pedidos</span>
                            <div class="menu-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="#">
                                    <span class="submenu-text">Novos Pedidos</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="submenu-text">Completos</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="submenu-text">Cancelados</span>
                                </a>
                            </li>
                        </ul>
                    </li>-->

                    
                    <!--<li class="menu-title">SISTEMA</li>
                    <li class="menu-item">
                        <a href="#">
                            <div class="menu-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <span class="menu-text">Configurações</span>
                        </a>
                    </li>-->
                    
                </ul>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-panel">
                    <div class="user-avatar">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">{{ Auth::user()->user_type }}</span>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Sair</span>
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <div class="header-left">
                    <button class="sidebar-toggle" id="sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="header-title">
                        <h1>Gerenciamento de Clientes</h1>
                        <!-- <nav class="breadcrumb">
                            <a href="#">Home</a>
                            <i class="fas fa-chevron-right"></i>
                            <span>Dashboard</span>
                        </nav>-->
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-actions">
                        <button class="theme-toggle" id="theme-toggle">
                            <i class="fas fa-moon"></i>
                            <i class="fas fa-sun"></i>
                        </button>
                        
                           
                        <div class="header-profile">
                            <div class="profile-avatar">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" alt="{{ Auth::user()->name }}">
                            </div>
                            <div class="profile-dropdown">
                                <div class="profile-header">
                                    <div class="profile-info">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <span>{{ Auth::user()->user_type }}</span>
                                    </div>
                                </div>
                                <div class="profile-links">
                                    <a href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user"></i>
                                        <span>Meu Perfil</span>
                                    </a>
                                   
                                </div>
                                <form method="POST" action="{{ route('logout') }}" class="profile-logout">
                                    @csrf
                                    <button type="submit">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Sair</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </header>
            
            <div class="card">


        <div class="clients-management">
    <div class="page-header">
        <h2 class="page-title"></h2>
        <div class="header-actions">
            <div class="search-box">
                <input type="text" id="clientSearch" placeholder="Pesquisar por ID, nome, email ou tipo...">
                <i class="fas fa-search"></i>
            </div>
            <a href="{{ route('clients.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Adicionar Cliente
            </a>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="pagination-container mt-4">
    {{ $clients->links('vendor.pagination.simple-numbers') }}
</div>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Cadastro</th>
                            <th>Status</th>
                            <th>Plano</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td>#{{ $client->id }}</td>
                            <td>
                                <div class="user-info">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($client->name) }}&background=random&color=fff" 
                                         alt="{{ $client->name }}" class="user-avatar">
                                    <span>{{ $client->name }}</span>
                                </div>
                            </td>
                            <td>{{ $client->email }}</td>
                            <td>
                                <span class="badge {{ $client->user_type === 'admin' ? 'badge-primary' : 'badge-secondary' }}">
                                    {{ $client->user_type }}
                                </span>
                            </td>
                            <td>{{ $client->created_at->format('d/m/Y') }}</td>
                            <td>
                            @if($client->isOnline())                              
                                    <span class="badge badge-success">
                                        <i class="fas fa-circle"></i> Online
                                    </span>
                                @else
                                    <span class="badge badge-secondary">
                                        Offline
                                    </span>
                                @endif
                            </td>  
                            <td>
                                @php
        $subscription = $client->cashierSubscriptions()
            ->where('stripe_status', 'active')
            ->where(function($query) {
                $query->whereNull('ends_at')
                      ->orWhere('ends_at', '>', now());
            })
            ->first();
            
        if ($subscription) {
            $plan = \App\Models\Plan::where('stripe_price_id', $subscription->stripe_price)->first();
            $plan ? $plan->name : 'Plano Ativo';
        } else {
            'Sem Plano';
        }
    @endphp     
                            <span class="badge {{ $subscription ? 'badge-primary' : 'badge-secondary' }}">
    @php
        $subscription = $client->cashierSubscriptions()
            ->where('stripe_status', 'active')
            ->where(function($query) {
                $query->whereNull('ends_at')
                      ->orWhere('ends_at', '>', now());
            })
            ->first();
            
        if ($subscription) {
            $plan = \App\Models\Plan::where('stripe_price_id', $subscription->stripe_price)->first();
            echo $plan ? $plan->name : 'Plano Ativo';
        } else {
            echo 'Sem Plano';
        }
    @endphp
</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-info" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
       
    </div>
    
</div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle Sidebar
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebar-toggle');
            const closeBtn = document.getElementById('sidebar-close');
            
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                document.querySelector('.main-content').classList.toggle('expanded');
            });
            
            closeBtn.addEventListener('click', function() {
                sidebar.classList.add('collapsed');
                document.querySelector('.main-content').classList.add('expanded');
            });
            
            // Submenu toggle
            const submenuItems = document.querySelectorAll('.has-submenu > a');
            submenuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const submenu = this.nextElementSibling;
                    const parent = this.parentElement;
                    
                    parent.classList.toggle('open');
                    submenu.style.maxHeight = parent.classList.contains('open') 
                        ? submenu.scrollHeight + 'px' 
                        : '0';
                });
            });
            
            // Theme Toggle
            const themeToggle = document.getElementById('theme-toggle');
            themeToggle.addEventListener('click', function() {
                document.body.classList.toggle('dark-mode');
                
                if (document.body.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
            });
            
            // Check for saved theme preference
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark-mode');
            }
            
            
            // Profile dropdown
            const profileAvatar = document.querySelector('.profile-avatar');
            const profileDropdown = document.querySelector('.profile-dropdown');
            
            profileAvatar.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');   
            });
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                notificationDropdown.classList.remove('show');
                profileDropdown.classList.remove('show');
            });
        });

        // Client search functionality
const clientSearch = document.getElementById('clientSearch');
const clientRows = document.querySelectorAll('.clients-management .table tbody tr');

clientSearch.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const isNumericSearch = /^\d+$/.test(searchTerm);
    
    clientRows.forEach(row => {
        const id = row.querySelector('td:nth-child(1)').textContent.toLowerCase().replace('#', '');
        const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const type = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        
        const matchId = isNumericSearch ? id === searchTerm : id.includes(searchTerm);
        const matchName = name.includes(searchTerm);
        const matchEmail = email.includes(searchTerm);
        const matchType = type.includes(searchTerm);
        
        if (matchId || matchName || matchEmail || matchType) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
    </script>
</body>
</html>