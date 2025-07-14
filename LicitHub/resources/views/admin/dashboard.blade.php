@php
    $user = auth()->user();
    if (!($user->user_type === 'admin')) {
        header('Location: ' . url('/'));
        exit;
    }

    // Obter dados reais do banco de dados
    $totalCustomers = App\Models\User::where('user_type', 'customer')->count();
    $totalAdmins = App\Models\User::where('user_type', 'admin')->count();
    $totalSubscriptions = App\Models\CashierSubscription::where('stripe_status', 'active')->count();
    $totalRevenue = App\Models\Payment::where('status', 'paid')->sum('amount');
    
    // Atividade recente (últimos 7 dias)
    $recentUsers = App\Models\User::with('subscriptions')
        ->where('created_at', '>=', now()->subDays(7))
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();

    $recentSubscriptions = App\Models\CashierSubscription::with('user')
        ->where('created_at', '>=', now()->subDays(7))
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();

    $recentPayments = App\Models\Payment::with('user')
        ->where('created_at', '>=', now()->subDays(7))
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();

    
@endphp

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard | Sistema de Gerenciamento</title>
    
    <!-- Fontes e Ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Assets -->
    @vite(['resources/css/admin.css'])
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon.png">
    
    <!-- Meta Tags -->
    <meta name="description" content="Painel administrativo completo para gerenciamento de clientes, produtos e pedidos">
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
                    <li class="menu-item active">
                        <a href="{{ route('admin.dashboard') }}">
                            <div class="menu-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <span class="menu-text">Dashboard</span>
                        </a>
                        

        
                    
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
                    <li class="menu-item">
                        <a href="{{ route('plans.index') }}">
                            <div class="menu-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <span class="menu-text">Planos</span>
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
                        <h1>Dashboard - {{ Auth::user()->name }}</h1>
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
                <div class="dashboard-overview">
                    <div class="cards-grid">
                        <div class="card">
                            <div class="card-icon bg-gradient-blue">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="card-info">
                                <h3>Total de Clientes</h3>
                                <span>{{ $totalCustomers }}</span>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-icon bg-gradient-green">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div class="card-info">
                                <h3>Administradores</h3>
                                <span>{{ $totalAdmins }}</span>
                            </div>
                        </div>
        
                        <div class="card">
                            <div class="card-icon bg-gradient-purple">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div class="card-info">
                                <h3>Assinaturas Ativas</h3>
                                <span>{{ $totalSubscriptions }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard-content-full">
                        <div class="content-section-full">
                            <div class="section-header">
                                <h2>Atividade Recente</h2>
                                <div class="section-actions">
                                    <a href="#" class="btn btn-link">Ver Tudo</a>
                                </div>
                            </div>
                            <div class="section-content-full">
                                <div class="activity-list">
                                    <!-- Novos Usuários -->
                                    @foreach($recentUsers as $user)
                                        <div class="activity-item">
                                            <div class="activity-icon bg-green">
                                                <i class="fas fa-user-plus"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p><strong>Novo usuário registrado</strong> - {{ $user->name }}</p>
                                                <span class="activity-time">{{ $user->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="activity-meta">
                                                <span class="badge bg-light text-dark">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    <!-- Novas Assinaturas -->
                                    @foreach($recentSubscriptions as $subscription)
                                        <div class="activity-item">
                                            <div class="activity-icon bg-blue">
                                                <i class="fas fa-shopping-cart"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p><strong>Nova assinatura</strong> - {{ $subscription->user->name ?? 'Usuário desconhecido' }}</p>
                                                <span class="activity-time">{{ $subscription->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="activity-meta">
                                                <span class="badge bg-primary">{{ $subscription->stripe_status }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    <!-- Pagamentos Recentes -->
                                    @foreach($recentPayments as $payment)
                                        <div class="activity-item">
                                            <div class="activity-icon bg-orange">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p><strong>Pagamento recebido</strong> - {{ $payment->user->name ?? 'Usuário desconhecido' }}</p>
                                                <span class="activity-time">{{ $payment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="activity-meta">
                                                <span class="badge bg-success">R$ {{ number_format($payment->amount, 2, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

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
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                profileDropdown.classList.remove('show');
            });
        });
    </script>
</body>
</html>