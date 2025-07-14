<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LicitHub - Encontre todas as licitações em um só lugar</title>
  <meta name="description" content="Sistema completo para participação em licitações. Encontre licitações e organize sua participação.">
  @vite(['resources/css/welcome.css'])
    
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
  <!-- Header -->
<header class="header" id="header">
  <div class="container">
    <div class="logo">
      <img src="icons/logo.png" alt="LicitHub">
    </div>
    <nav class="main-nav">
      <ul class="nav-links">
        <li><a href="#home" class="active">Home</a></li>
        <li><a href="#recursos">Recursos</a></li>
        <li><a href="#como-funciona">Como Funciona</a></li>
        <li><a href="#planos">Planos</a></li>
        <li><a href="#licitacoes">Licitações</a></li>
        <li><a href="#testemunhas">Testemunhas</a></li>
        <li><a href="#contato">Contato</a></li>
      </ul>        
    </nav>
    <div class="auth-buttons">
      <?php if(isset($_SESSION['user_id'])): ?>
        <!-- Se o usuário estiver logado -->
        <?php if($_SESSION['user_type'] === 'admin'): ?>
          <a href="../adm/dashboard.php" class="btn btn-primary">Dashboard Admin</a>
        <?php endif; ?>
        <a href="logout.php" class="btn btn-outline">Sair</a>
      <?php else: ?>
        <!-- Se o usuário não estiver logado -->
        <a href="../login/login.php" class="btn btn-outline">Entrar</a>
        <a href="../login/cadastro.php" class="btn btn-primary">Cadastrar</a>
      <?php endif; ?>
    </div>
    <div class="mobile-menu-btn">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</header>

  <!-- Hero Section -->
  <section class="hero" id="home">
    <div class="container">
      <div class="hero-content">
        <h1>Encontre todas as licitações em um só lugar</h1>
        <p>Sistema completo para participação em licitações. Encontre licitações e organize sua participação.</p>
        <div class="cta-buttons">
          <a href="#cadastro" class="btn btn-primary btn-lg">Começar agora</a>
          <a href="#planos" class="btn btn-outline btn-lg">Ver planos</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="icons/fundo2.png" alt="LicitHub Platform">
      </div>
    </div>
  </section>

  <!-- Advantages Section -->
  <section class="advantages" id="recursos">
    <div class="container">
      <div class="section-header">
        <h2>Por que escolher a LicitHub?</h2>
        <p>Nossa plataforma oferece diversas vantagens para empresas que participam de licitações</p>
      </div>
      <div class="advantages-grid">
        <div class="advantage-card">
          <div class="advantage-icon">
            <img src="icons/lupa.png" alt="Busca Avançada">
          </div>
          <h3>Busca Avançada</h3>
          <p>Encontre licitações de acordo com seus interesses com filtros personalizados.</p>
        </div>
        
        <div class="advantage-card">
          <div class="advantage-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-download" viewBox="0 0 16 16">
              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
              <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
            </svg>          </div>
          <h3>Organização</h3>
          <p>Acompanhe e organize suas participações em licitações em um só lugar.</p>
        </div>
        <div class="advantage-card">
          <div class="advantage-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-headset" viewBox="0 0 16 16">
              <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5"/>
            </svg>          </div>
          <h3>Suporte Completo</h3>
          <p>Equipe especializada pronta para ajudar com quaisquer dúvidas.</p>
        </div>
        <div class="advantage-card">
          <div class="advantage-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-person-check" viewBox="0 0 16 16">
              <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
              <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
            </svg>          </div>
          <h3>Dashboard Intuitivo</h3>
          <p>Interface amigável para gerenciar todas as suas atividades.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Counter Section -->
  <section class="counter-section">
    <div class="container">
      <div class="counter-grid">
        <div class="counter-item">
          <div class="counter-number" data-count="123">0</div>
          <div class="counter-text">Licitações diárias</div>
        </div>
        <div class="counter-item">
          <div class="counter-number" data-count="1627">0</div>
          <div class="counter-text">Clientes satisfeitos</div>
        </div>
        <div class="counter-item">
          <div class="counter-number" data-count="98">0</div>
          <div class="counter-text">% de aprovação</div>
        </div>
        <div class="counter-item">
          <div class="counter-number" data-count="24">0</div>
          <div class="counter-text">Horas de suporte</div>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="how-it-works" id="como-funciona">
    <div class="container">
      <div class="section-header">
        <h2>Como funciona</h2>
        <p>Participar de licitações nunca foi tão simples</p>
      </div>
      <div class="steps-container">
        <div class="step">
          <div class="step-number">1</div>
          <div class="step-content">
            <h3>Cadastre-se</h3>
            <p>Crie sua conta gratuitamente em menos de 2 minutos.</p>
          </div>
        </div>
        <div class="step">
          <div class="step-number">2</div>
          <div class="step-content">
            <h3>Configure seus interesses</h3>
            <p>Defina critérios para licitações que combinam com seu negócio.</p>
          </div>
        </div>
        <div class="step">
          <div class="step-number">3</div>
          <div class="step-content">
            <h3>Receba notificações</h3>
            <p>Seja notificado sobre oportunidades que correspondem aos seus interesses.</p>
          </div>
        </div>
        <div class="step">
          <div class="step-number">4</div>
          <div class="step-content">
            <h3>Participe e ganhe</h3>
            <p>Prepare suas propostas com mais eficiência e aumente suas chances.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Pricing Section - Substituída pelo conteúdo fornecido -->
  <section class="pricing py-5 bg-light" id="planos">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Planos e Preços</h2>
            <p class="text-muted">Escolha o plano que melhor se adapta à sua empresa</p>
        </div>

        <div class="row justify-content-center">
            @foreach ($plans as $plan)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-lg position-relative {{ $loop->iteration === 2 ? 'highlighted-plan' : '' }}">
                        
                        @if ($loop->iteration === 2)
                            <div class="ribbon-top bg-primary text-white fw-bold">Mais Popular</div>
                        @endif

                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title text-center fw-semibold mb-3">{{ $plan->name }}</h5>
                            
                            <h6 class="card-price text-center text-primary mb-4 fs-4">
                                R${{ number_format($plan->price, 2, ',', '.') }}
                                <small class="text-muted fs-6">/{{ $plan->interval === 'year' ? 'ano' : 'mês' }}</small>
                            </h6>

                            <ul class="list-unstyled mb-4 flex-grow-1 px-2">
                                @php
                                    $features = is_array($plan->features) ? $plan->features : explode("\n", $plan->features);
                                @endphp
                                @foreach ($features as $feature)
                                    @php
                                        $feature = trim($feature);
                                        $isDisabled = str_starts_with($feature, '-');
                                    @endphp
                                    <li class="mb-2 d-flex align-items-start {{ $isDisabled ? 'text-muted text-decoration-line-through' : '' }}">
                                        <i class="me-2 {{ $isDisabled ? 'bi-x-circle' : 'bi-check-circle text-success' }}"></i>
                                        <span>{{ $isDisabled ? ltrim($feature, '-') : $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <a href="{{ route('register') }}"
                               class="btn {{ $loop->iteration === 2 ? 'btn-primary' : 'btn-outline-primary' }} mt-auto w-100 fw-bold">
                                Escolher Plano
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


  <!-- Licitações Exclusivas -->
<section class="licitacoes" id="licitacoes">
  <div class="container">
    <div class="section-header">
      <h2>Licitações Exclusivas</h2>
      <p>Serviços premium disponíveis apenas para assinantes</p>
    </div>
    <div class="licitacoes-grid">
      <div class="licitacao-card">
        <h3>Monitoramento Diário</h3>
        <p>Acompanhe em tempo real novas oportunidades de licitação conforme seus filtros de interesse.</p>
      </div>
      <div class="licitacao-card">
        <h3>Alertas Personalizados</h3>
        <p>Receba notificações sobre licitações relevantes direto no seu e-mail ou painel.</p>
      </div>
      <div class="licitacao-card">
        <h3>Download de Editais</h3>
        <p>Tenha acesso rápido e ilimitado aos documentos dos editais disponíveis na plataforma.</p>
      </div>
      <div class="licitacao-card">
        <h3>Consultoria Especializada</h3>
        <p>Conte com suporte estratégico para análise de licitações e montagem de propostas.</p>
      </div>
    </div>
    <div class="text-center mt-5">
      <a href="../login/cadastro.html" class="btn btn-primary btn-lg">Quero Acessar</a>
    </div>
  </div>
</section>


  <!-- Testimonials Section -->
  <section class="testimonials" id="testemunhas">
    <div class="container">
      <div class="section-header">
        <h2>O que dizem nossos clientes</h2>
        <p>Centenas de empresas já utilizam nossa plataforma diariamente</p>
      </div>
      <div class="testimonials-slider">
        <div class="testimonial-slide active">
          <div class="testimonial-content">
            <div class="testimonial-quote">
              <p>"A LicitHub revolucionou nossa forma de trabalhar com licitações. O tempo que economizamos na busca e organização foi imenso. Recomendo fortemente!"</p>
            </div>
            <div class="testimonial-author">
              <img src="icons/cliente1.png" alt="Daniela Machado">
              <div class="author-info">
                <h4>Daniela Machado</h4>
                <p>Gerente de Licitações, Tech Solutions</p>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-slide">
          <div class="testimonial-content">
            <div class="testimonial-quote">
              <p>"Desde que começamos a usar a plataforma, nossa taxa de sucesso em licitações aumentou em 40%. O sistema é intuitivo e o suporte é excelente."</p>
            </div>
            <div class="testimonial-author">
              <img src="icons/testimonial-2.png" alt="Sergio Foguetes">
              <div class="author-info">
                <h4>Sérgio Dos Foguetes</h4>
                <p>Diretor Comercial, Construtora ABC</p>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-slide">
          <div class="testimonial-content">
            <div class="testimonial-quote">
              <p>"A melhor plataforma para quem trabalha com licitações. As notificações personalizadas garantem que nunca perdemos uma oportunidade importante."</p>
            </div>
            <div class="testimonial-author">
              <img src="icons/testimonial-3.png" alt="Ana Oliveira">
              <div class="author-info">
                <h4>Ana Oliveira</h4>
                <p>CEO, Serviços Médicos Ltda.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="testimonial-dots">
        <span class="dot active" data-slide="0"></span>
        <span class="dot" data-slide="1"></span>
        <span class="dot" data-slide="2"></span>
      </div>
    </div>
  </section>

  <!-- Clients Section -->
  <section class="clients">
    <div class="container">
      <div class="section-header">
        <h2>Empresas que confiam em nós</h2>
      </div>
      <div class="clients-grid">
        <div class="client-logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="black" class="bi bi-github" viewBox="0 0 16 16">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
          </svg>        </div>
        <div class="client-logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="black" class="bi bi-youtube" viewBox="0 0 16 16">
            <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
          </svg>        </div>
        <div class="client-logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="black" class="bi bi-browser-edge" viewBox="0 0 16 16">
            <path d="M9.482 9.341c-.069.062-.17.153-.17.309 0 .162.107.325.3.456.877.613 2.521.54 2.592.538h.002c.667 0 1.32-.18 1.894-.519A3.84 3.84 0 0 0 16 6.819c.018-1.316-.44-2.218-.666-2.664l-.04-.08C13.963 1.487 11.106 0 8 0A8 8 0 0 0 .473 5.29C1.488 4.048 3.183 3.262 5 3.262c2.83 0 5.01 1.885 5.01 4.797h-.004v.002c0 .338-.168.832-.487 1.244l.006-.006z"/>
            <path d="M.01 7.753a8.14 8.14 0 0 0 .753 3.641 8 8 0 0 0 6.495 4.564 5 5 0 0 1-.785-.377h-.01l-.12-.075a5.5 5.5 0 0 1-1.56-1.463A5.543 5.543 0 0 1 6.81 5.8l.01-.004.025-.012c.208-.098.62-.292 1.167-.285q.194.001.384.033a4 4 0 0 0-.993-.698l-.01-.005C6.348 4.282 5.199 4.263 5 4.263c-2.44 0-4.824 1.634-4.99 3.49m10.263 7.912q.133-.04.265-.084-.153.047-.307.086z"/>
            <path d="M10.228 15.667a5 5 0 0 0 .303-.086l.082-.025a8.02 8.02 0 0 0 4.162-3.3.25.25 0 0 0-.331-.35q-.322.168-.663.294a6.4 6.4 0 0 1-2.243.4c-2.957 0-5.532-2.031-5.532-4.644q.003-.203.046-.399a4.54 4.54 0 0 0-.46 5.898l.003.005c.315.441.707.821 1.158 1.121h.003l.144.09c.877.55 1.721 1.078 3.328.996"/>
          </svg>        </div>
        <div class="client-logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="black" class="bi bi-browser-edge" viewBox="0 0 16 16">
            <path d="M10.813 11.968c.157.083.36.074.5-.05l.005.005a90 90 0 0 1 1.623-1.405c.173-.143.143-.372.006-.563l-.125-.17c-.345-.465-.673-.906-.673-1.791v-3.3l.001-.335c.008-1.265.014-2.421-.933-3.305C10.404.274 9.06 0 8.03 0 6.017 0 3.77.75 3.296 3.24c-.047.264.143.404.316.443l2.054.22c.19-.009.33-.196.366-.387.176-.857.896-1.271 1.703-1.271.435 0 .929.16 1.188.55.264.39.26.91.257 1.376v.432q-.3.033-.621.065c-1.113.114-2.397.246-3.36.67C3.873 5.91 2.94 7.08 2.94 8.798c0 2.2 1.387 3.298 3.168 3.298 1.506 0 2.328-.354 3.489-1.54l.167.246c.274.405.456.675 1.047 1.166ZM6.03 8.431C6.03 6.627 7.647 6.3 9.177 6.3v.57c.001.776.002 1.434-.396 2.133-.336.595-.87.961-1.465.961-.812 0-1.286-.619-1.286-1.533M.435 12.174c2.629 1.603 6.698 4.084 13.183.997.28-.116.475.078.199.431C13.538 13.96 11.312 16 7.57 16 3.832 16 .968 13.446.094 12.386c-.24-.275.036-.4.199-.299z"/>
            <path d="M13.828 11.943c.567-.07 1.468-.027 1.645.204.135.176-.004.966-.233 1.533-.23.563-.572.961-.762 1.115s-.333.094-.23-.137c.105-.23.684-1.663.455-1.963-.213-.278-1.177-.177-1.625-.13l-.09.009q-.142.013-.233.024c-.193.021-.245.027-.274-.032-.074-.209.779-.556 1.347-.623"/>
          </svg>        </div>
        <div class="client-logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="black" class="bi bi-browser-edge" viewBox="0 0 16 16">
            <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
          </svg>        </div>
        <div class="client-logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="black" class="bi bi-browser-edge" viewBox="0 0 16 16">
            <path d="M4.671 0c.88 0 1.733.247 2.468.702a7.42 7.42 0 0 1 6.02 2.118 7.37 7.37 0 0 1 2.167 5.215q0 .517-.072 1.026a4.66 4.66 0 0 1 .6 2.281 4.64 4.64 0 0 1-1.37 3.294A4.67 4.67 0 0 1 11.18 16c-.84 0-1.658-.226-2.37-.644a7.42 7.42 0 0 1-6.114-2.107A7.37 7.37 0 0 1 .529 8.035q0-.545.08-1.081a4.644 4.644 0 0 1 .76-5.59A4.68 4.68 0 0 1 4.67 0zm.447 7.01c.18.309.43.572.729.769a7 7 0 0 0 1.257.653q.737.308 1.145.523c.229.112.437.264.615.448.135.142.21.331.21.528a.87.87 0 0 1-.335.723c-.291.196-.64.289-.99.264a2.6 2.6 0 0 1-1.048-.206 11 11 0 0 1-.532-.253 1.3 1.3 0 0 0-.587-.15.72.72 0 0 0-.501.176.63.63 0 0 0-.195.491.8.8 0 0 0 .148.482 1.2 1.2 0 0 0 .456.354 5.1 5.1 0 0 0 2.212.419 4.6 4.6 0 0 0 1.624-.265 2.3 2.3 0 0 0 1.08-.801c.267-.39.402-.855.386-1.327a2.1 2.1 0 0 0-.279-1.101 2.5 2.5 0 0 0-.772-.792A7 7 0 0 0 8.486 7.3a1 1 0 0 0-.145-.058 18 18 0 0 1-1.013-.447 1.8 1.8 0 0 1-.54-.387.73.73 0 0 1-.2-.508.8.8 0 0 1 .385-.723 1.76 1.76 0 0 1 .968-.247c.26-.003.52.03.772.096q.412.119.802.293c.105.049.22.075.336.076a.6.6 0 0 0 .453-.19.7.7 0 0 0 .18-.496.72.72 0 0 0-.17-.476 1.4 1.4 0 0 0-.556-.354 3.7 3.7 0 0 0-.708-.183 6 6 0 0 0-1.022-.078 4.5 4.5 0 0 0-1.536.258 2.7 2.7 0 0 0-1.174.784 1.9 1.9 0 0 0-.45 1.287c-.01.37.076.736.25 1.063"/>
          </svg>        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta" id="contato">
    <div class="container">
      <div class="cta-content">
        <h2>Entre em contato com a nossa equipe</h2>
        <p>Estamos prontos para ajudar você a tirar dúvidas, entender melhor nossos planos ou dar o próximo passo rumo ao sucesso em licitações.</p>
        <a href="../contato/contato.html" class="btn btn-primary btn-lg animated-link">Entre em Contato</a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <section id="footer">
    <footer class="footer">  
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <div class="footer-logo">
            <img src="icons/logo-branca.png" alt="LicitHub" color="white">
          </div>
          <p>Transformando a forma como empresas participam de licitações públicas desde 2024.</p>
          <div class="social-links">
            <a href="https://github.com/KauanDosAnjosVieira/PROJECT-SA-2025" class="social-link" target="_blank">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
              </svg>            </a> 
            <a href="https://www.instagram.com/kgbsolutions/" class="social-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
              </svg>            </a>
        
          </div>
        </div>
        <div class="footer-col">
          <h3>Links Rápidos</h3>
          <ul class="footer-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#recursos">Recursos</a></li>
            <li><a href="#como-funciona">Como Funciona</a></li>
            <li><a href="#planos">Planos</a></li>
            <li><a href="#testemunhas">Testemunhas</a></li>
            <li><a href="#contato">Contato</a></li>
          </ul>
        </div>
       
        <div class="footer-col">
          <h3>Contato</h3>
          <ul class="contact-info">
            <li><i class="fas fa-envelope"></i> kgb.licithub@gmail.com.br</li>
            <li><i class="fas fa-phone"></i> (47) 3456-7890</li>
            <li><i class="fas fa-map-marker-alt"></i> R. Arno Waldemar Döhler, 957 - Zona Industrial Norte, Joinville - SC</li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 LicitHub. Todos os direitos reservados.</p>
      </div>
    </div>
  </footer>
</section>

  @vite(['resources/js/welcome.js'])
</body>
</html>