<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel' ) }} - Área do Cliente</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css' ) }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ asset('js/app.js' ) }}" defer></script>
    
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        
        .nav-link {
            color: #495057;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: #e9ecef;
            color: #0d6efd;
        }
        
        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .navbar {
            padding: 0.75rem 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: #fff;
        }
        
        .content {
            padding: 1.5rem;
        }
        
        .subscription-info {
            padding: 10px;
        }
        
        .subscription-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }
        
        .card-header {
            font-weight: 600;
        }
        
        .badge-notification {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 0.7rem;
        }
        
        .dropdown-menu {
            right: 0;
            left: auto;
        }
        
        @media (max-width: 767.98px) {
            .sidebar {
                min-height: auto;
            }
        }
        
        /* Chat specific styles */
        .chat-messages {
            height: 400px;
            overflow-y: auto;
            background-color: #f8f9fa;
            padding: 15px;
        }
        
        .message-content {
            padding: 10px 15px;
            border-radius: 15px;
            max-width: 80%;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        
        .message-time {
            font-size: 0.8rem;
            margin-top: 5px;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div id="app">


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @auth
                    <div class="col-md-3 col-lg-2 d-md-block sidebar">
                        <div class="text-center mb-4">
                            <h4>Menu do Cliente</h4>
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('client/dashboard') ? 'active' : '' }}" href="{{ route('client.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('client/chat*') ? 'active' : '' }}" href="{{ route('client.chat') }}">
                                    <i class="fas fa-headset"></i>
                                    Suporte
                                    @php
                                        $unreadCount = 0;
                                        if (class_exists('App\Models\ChatMessage')) {
                                            $unreadCount = \App\Models\ChatMessage::where('to_user_id', Auth::id())
                                                ->where('is_read', false)
                                                ->count();
                                        }
                                    @endphp
                                    @if($unreadCount > 0)
                                        <span class="badge bg-danger float-end">{{ $unreadCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                    <i class="fas fa-home"></i>
                                    Página Inicial
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Sair
                                </a>
                                <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 content">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        @yield('content')
                    </main>
                @else
                    <main class="col-12 py-4">
                        @yield('content')
                    </main>
                @endauth
            </div>
        </div>
        
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container text-center">
                <span class="text-muted">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos os direitos reservados.</span>
            </div>
        </footer>
    </div>
    
    @stack('scripts')
</body>
</html>