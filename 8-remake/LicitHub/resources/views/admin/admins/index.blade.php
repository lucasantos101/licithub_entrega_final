-<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Pro | Gerenciar Admins</title>
    
    <!-- Fontes e Ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    @vite(['resources/css/admin.css'])

    
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
                    <li class="menu-item">
                        <a href="{{ route('clients.index') }}">
                            <div class="menu-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="menu-text">Clientes</span>
                        </a>
                    </li>
                    <li class="menu-item active">
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
                        <h1>Gerenciamento de Admins</h1>
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
            
            <div class="clients-management">
            <div class="page-header">
    <h2 class="page-title"></h2>
    <div class="header-actions">
        <div class="search-box">
            <input type="text" id="adminSearch" placeholder="Pesquisar por ID, nome ou email...">
            <i class="fas fa-search"></i>
        </div>
        <a href="{{ route('admins.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Adicionar Admin
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
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Cadastro</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <td>#{{ $admin->id }}</td>
                            <td>
                                <div class="user-info">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=random&color=fff" 
                                         alt="{{ $admin->name }}" class="user-avatar">
                                    <span>{{ $admin->name }}</span>
                                </div>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <span class="badge {{ $admin->user_type === 'admin' ? 'badge-primary' : 'badge-secondary' }}">
                                    {{ $admin->user_type }}
                                </span>
                            </td>
                            <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                            <td>
                            <span class="badge bg-light text-dark">
                            @if($admin->isOnline())                              
                                    <span class="badge badge-success">
                                        <i class="fas fa-circle"></i> Online
                                    </span>
                                @else
                                    <span class="badge badge-secondary">
                                        Offline
                                    </span>
                                @endif
                            </span>
                            </td>
                   
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admins.show', $admin) }}" class="btn btn-sm btn-info" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admins.edit', $admin) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admins.destroy', $admin) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este admin?')">
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

// Admin search functionality
const adminSearch = document.getElementById('adminSearch');
const adminRows = document.querySelectorAll('.table tbody tr');

adminSearch.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    
    adminRows.forEach(row => {
        const id = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
        const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const type = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        
        if (id.includes(searchTerm) || name.includes(searchTerm) || email.includes(searchTerm) || type.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
    </script>
</body>
</html>