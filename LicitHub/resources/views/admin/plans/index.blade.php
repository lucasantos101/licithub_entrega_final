<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Pro | Gerenciar Planos</title>
    
    <!-- Fontes e Ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    @vite(['resources/css/admin.css'])
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon.png">
    
    <style>
        /* Estilos específicos para a página de planos */
        .plans-management {
            padding: 20px;
        }

        .search-box {
            position: relative;
            margin-right: 15px;
        }

        .search-box input {
            padding: 8px 15px 8px 35px;
            border-radius: 4px;
            border: 1px solid var(--border-color);
            width: 250px;
            transition: all 0.3s;
            background-color: var(--card-bg);
            color: var(--text-color);
        }

        .search-box input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(var(--primary-rgb), 0.1);
            outline: none;
        }

        .search-box i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .advanced-filters {
            background-color: var(--card-bg);
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
        }

        .filter-row {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-group label {
            margin-bottom: 0;
            font-weight: 500;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .badge {
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 500;
            border-radius: 4px;
        }

        .badge-success {
            background-color: var(--success-color);
            color: white;
        }

        .badge-secondary {
            background-color: var(--secondary-bg);
            color: var(--text-color);
        }

        .badge-info {
            background-color: var(--info-color);
            color: white;
        }

        .header-actions {
            display: flex;
            align-items: center;
        }
    </style>
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
                    <li class="menu-item">
                        <a href="{{ route('admins.index') }}">
                            <div class="menu-icon">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="menu-text">Administradores</span>
                        </a>
                    </li>
                    <li class="menu-item active">
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
                        <h1>Gerenciamento de Planos</h1>
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

            <div class="content-wrapper">
                <div class="plans-management">
                    <div class="page-header">
                        <div class="header-left">
                            <h2 class="page-title"></h2>
                        </div>
                        <div class="header-actions">
                            <div class="search-box">
                                <input type="text" id="planSearch" placeholder="Pesquisar planos...">
                                <i class="fas fa-search"></i>
                            </div>
                            <a href="{{ route('plans.create') }}" class="btn btn-success">
                                <i class="fas fa-plus-circle"></i> Adicionar Plano
                            </a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    <div class="advanced-filters mb-3">
                        <div class="filter-row">
                            <div class="filter-group">
                                <label>Status:</label>
                                <select id="statusFilter" class="form-control-sm">
                                    <option value="">Todos</option>
                                    <option value="active">Ativos</option>
                                    <option value="inactive">Inativos</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label>Intervalo:</label>
                                <select id="intervalFilter" class="form-control-sm">
                                    <option value="">Todos</option>
                                    <option value="month">Mensal</option>
                                    <option value="year">Anual</option>
                                </select>
                            </div>
                            <button id="resetFilters" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-undo"></i> Limpar Filtros
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="plansTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Preço</th>
                                            <th>Intervalo</th>
                                            <th>Trial</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($plans as $plan)
                                        <tr>
                                            <td>#{{ $plan->id }}</td>
                                            <td>{{ $plan->name }}</td>
                                            <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $plan->interval == 'month' ? 'Mensal' : 'Anual' }}
                                                </span>
                                            </td>
                                            <td>{{ $plan->trial_days }} dias</td>
                                            <td>
                                                <span class="badge {{ $plan->is_active ? 'badge-success' : 'badge-secondary' }}">
                                                    {{ $plan->is_active ? 'Ativo' : 'Inativo' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('plans.show', $plan) }}" class="btn btn-sm btn-info" title="Detalhes">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('plans.edit', $plan) }}" class="btn btn-sm btn-warning" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('plans.destroy', $plan) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir" 
                                                            onclick="return confirm('Tem certeza que deseja excluir este plano?')">
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
            </div>
        </main>
    </div>

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
                profileDropdown.classList.remove('show');
            });

            // Filtros de planos
            const planSearch = document.getElementById('planSearch');
            const statusFilter = document.getElementById('statusFilter');
            const intervalFilter = document.getElementById('intervalFilter');
            const resetFilters = document.getElementById('resetFilters');
            const plansTable = document.getElementById('plansTable');
            const planRows = plansTable.querySelectorAll('tbody tr');

            function applyFilters() {
                const searchTerm = planSearch.value.toLowerCase();
                const statusValue = statusFilter.value;
                const intervalValue = intervalFilter.value;

                planRows.forEach(row => {
                    const id = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const price = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const interval = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                    const status = row.querySelector('td:nth-child(6)').textContent.toLowerCase();

                    // Verifica correspondências
                    const matchesSearch = searchTerm === '' || 
                                       id.includes(searchTerm) || 
                                       name.includes(searchTerm) || 
                                       price.includes(searchTerm);

                    const matchesStatus = statusValue === '' || 
                                      (statusValue === 'active' && status.includes('ativo')) || 
                                      (statusValue === 'inactive' && status.includes('inativo'));

                    const matchesInterval = intervalValue === '' || 
                                        (intervalValue === 'month' && interval.includes('mensal')) || 
                                        (intervalValue === 'year' && interval.includes('anual'));

                    // Mostra/oculta linha baseado nos filtros
                    row.style.display = (matchesSearch && matchesStatus && matchesInterval) ? '' : 'none';
                });
            }

            // Event listeners
            planSearch.addEventListener('input', applyFilters);
            statusFilter.addEventListener('change', applyFilters);
            intervalFilter.addEventListener('change', applyFilters);

            resetFilters.addEventListener('click', function() {
                planSearch.value = '';
                statusFilter.value = '';
                intervalFilter.value = '';
                applyFilters();
            });

            // Aplicar filtros inicialmente
            applyFilters();
        });
    </script>
</body>
</html>