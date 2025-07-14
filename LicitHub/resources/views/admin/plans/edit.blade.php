<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Plano</title>
    @vite(['resources/css/admin.css'])
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --border-radius: 0.375rem;
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        body.light-mode {
            background-color: #f8fafc;
            color: var(--gray-800);
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--gray-800);
            margin: 0;
        }

        form {
            background-color: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            margin-top: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--gray-700);
        }

        .form-control {
            width: 100%;
            padding: 0.625rem 0.875rem;
            border: 1px solid var(--gray-300);
            border-radius: var(--border-radius);
            font-size: 1rem;
            line-height: 1.5;
            color: var(--gray-800);
            background-color: white;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .text-muted {
            font-size: 0.875rem;
            color: var(--gray-500);
            display: block;
            margin-top: 0.25rem;
        }

        .input-group {
            display: flex;
            margin-bottom: 0.5rem;
        }

        .input-group .form-control {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group-append {
            display: flex;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            border-radius: var(--border-radius);
            font-weight: 500;
            font-size: 0.875rem;
            line-height: 1.25rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-success:hover {
            background-color: #0d9e6e;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: var(--gray-200);
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background-color: var(--gray-300);
        }

        .btn-outline-secondary {
            background-color: white;
            border-color: var(--gray-300);
            color: var(--gray-700);
        }

        .btn-outline-secondary:hover {
            background-color: var(--gray-100);
        }

        .btn-outline-danger {
            background-color: white;
            border-color: var(--danger);
            color: var(--danger);
        }

        .btn-outline-danger:hover {
            background-color: #fee2e2;
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-group {
            display: flex;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        /* Checkbox estilizado */
        [type="checkbox"] {
            width: 1rem;
            height: 1rem;
            color: var(--primary);
            border: 1px solid var(--gray-300);
            border-radius: 0.25rem;
            margin-right: 0.5rem;
        }

        [type="checkbox"]:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            border-color: var(--primary-light);
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1rem;
            }
            
            form {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="light-mode">
    <main class="content-wrapper">
        <div class="page-header">
            <h1 class="page-title">Editar Plano: {{ $plan->name }}</h1>
        </div>

        <form action="{{ route('plans.update', $plan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nome do Plano*</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $plan->name) }}" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug*</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $plan->slug) }}" required>
                <small class="text-muted">Identificador único (ex: plano-basico)</small>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $plan->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Preço* (R$)</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" min="0" value="{{ old('price', $plan->price) }}" required>
            </div>

            <div class="form-group">
                <label for="interval">Intervalo*</label>
                <select name="interval" id="interval" class="form-control" required>
                    <option value="month" {{ old('interval', $plan->interval) == 'month' ? 'selected' : '' }}>Mensal</option>
                    <option value="year" {{ old('interval', $plan->interval) == 'year' ? 'selected' : '' }}>Anual</option>
                </select>
            </div>

            <div class="form-group">
                <label for="trial_days">Dias de Trial</label>
                <input type="number" name="trial_days" id="trial_days" class="form-control" min="0" value="{{ old('trial_days', $plan->trial_days) }}">
            </div>

            <div class="form-group">
                <label for="stripe_price_id">ID do Preço no Stripe</label>
                <input type="text" name="stripe_price_id" id="stripe_price_id" class="form-control" value="{{ old('stripe_price_id', $plan->stripe_price_id) }}">
            </div>

            <div class="form-group">
                <label>
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $plan->is_active) ? 'checked' : '' }}>
                    Plano Ativo
                </label>
            </div>

            {{-- FEATURES --}}
            <div class="form-group">
                <label>Recursos Ativos (features)</label>
                <div id="features-container">
                    @php
                        $features = is_array($plan->features) ? $plan->features : json_decode($plan->features, true) ?? [];
                        $features = old('features', $features);
                    @endphp

                    @forelse ((array)$features as $feature)
                        <div class="input-group">
                            <input type="text" name="features[]" class="form-control" value="{{ $feature }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger remove-feature" type="button">−</button>
                            </div>
                        </div>
                    @empty
                        <div class="input-group">
                            <input type="text" name="features[]" class="form-control" placeholder="Recurso incluído">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary add-feature" type="button">+</button>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="btn btn-outline-secondary add-feature mt-2">+ Adicionar Recurso</button>
            </div>

            {{-- FEATURES OFF --}}
            <div class="form-group">
                <label>Recursos Bloqueados (features_off)</label>
                <div id="features-off-container">
                    @php
                        $featuresOff = is_array($plan->features_off) ? $plan->features_off : json_decode($plan->features_off, true) ?? [];
                        $featuresOff = old('features_off', $featuresOff);
                    @endphp

                    @forelse ((array)$featuresOff as $featureOff)
                        <div class="input-group">
                            <input type="text" name="features_off[]" class="form-control" value="{{ $featureOff }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger remove-feature-off" type="button">−</button>
                            </div>
                        </div>
                    @empty
                        <div class="input-group">
                            <input type="text" name="features_off[]" class="form-control" placeholder="Recurso bloqueado">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary add-feature-off" type="button">+</button>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" class="btn btn-outline-secondary add-feature-off mt-2">+ Adicionar Recurso Bloqueado</button>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-success">Atualizar Plano</button>
                <a href="{{ route('plans.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </main>

   
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Função para adicionar um novo campo de recurso
            function addFeatureField(containerId, placeholder, isFeatureOff = false) {
                const container = document.getElementById(containerId);
                const newInput = document.createElement('div');
                newInput.className = 'input-group mt-2';
                
                const inputName = isFeatureOff ? 'features_off[]' : 'features[]';
                const removeClass = isFeatureOff ? 'remove-feature-off' : 'remove-feature';
                
                newInput.innerHTML = `
                    <input type="text" name="${inputName}" class="form-control" placeholder="${placeholder}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-danger ${removeClass}" type="button">−</button>
                    </div>
                `;
                
                // Adiciona antes do botão "Adicionar Recurso"
                const addButton = container.querySelector('.add-feature' + (isFeatureOff ? '-off' : ''));
                container.insertBefore(newInput, addButton);
            }

            // Adicionar recurso ativo
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('add-feature')) {
                    addFeatureField('features-container', 'Recurso incluído');
                }

                // Adicionar recurso bloqueado
                if (e.target.classList.contains('add-feature-off')) {
                    addFeatureField('features-off-container', 'Recurso bloqueado', true);
                }

                // Remover campos de recursos ativos
                if (e.target.classList.contains('remove-feature')) {
                    e.target.closest('.input-group').remove();
                }

                // Remover campos de recursos bloqueados
                if (e.target.classList.contains('remove-feature-off')) {
                    e.target.closest('.input-group').remove();
                }
            });

            // Adiciona margem superior para os botões de adicionar
            document.querySelectorAll('.add-feature, .add-feature-off').forEach(button => {
                button.classList.add('mt-2');
            });
        });
    </script>
</body>
</html>