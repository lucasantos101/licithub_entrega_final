<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Plano</title>
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
            <h1 class="page-title">Cadastrar Novo Plano</h1>
        </div>

        <form action="{{ route('plans.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nome do Plano*</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug*</label>
                <input type="text" name="slug" id="slug" class="form-control" required>
                <small class="text-muted">Identificador único (ex: plano-basico)</small>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Preço* (R$)</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" min="0" required>
            </div>

            <div class="form-group">
                <label for="interval">Intervalo*</label>
                <select name="interval" id="interval" class="form-control" required>
                    <option value="month">Mensal</option>
                    <option value="year">Anual</option>
                </select>
            </div>

            <div class="form-group">
                <label for="trial_days">Dias de Trial</label>
                <input type="number" name="trial_days" id="trial_days" class="form-control" min="0" value="0">
            </div>

            <div class="form-group">
                <label for="stripe_price_id">ID do Preço no Stripe</label>
                <input type="text" name="stripe_price_id" id="stripe_price_id" class="form-control">
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" checked>
                    Plano Ativo
                </label>
            </div>

            <div class="form-group">
                <label>Recursos Ativos (features)</label>
                <div id="features-container">
                    <div class="input-group">
                        <input type="text" name="features[]" class="form-control" placeholder="Recurso incluído">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary add-feature" type="button">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Recursos Bloqueados (features_off)</label>
                <div id="features-off-container">
                    <div class="input-group">
                        <input type="text" name="features_off[]" class="form-control" placeholder="Recurso bloqueado">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary add-feature-off" type="button">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-success">Salvar Plano</button>
                <a href="{{ route('plans.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Adicionar recurso ativo
            document.querySelector('.add-feature').addEventListener('click', function () {
                const container = document.getElementById('features-container');
                const newInput = document.createElement('div');
                newInput.className = 'input-group';
                newInput.innerHTML = `
                    <input type="text" name="features[]" class="form-control" placeholder="Recurso incluído">
                    <div class="input-group-append">
                        <button class="btn btn-danger remove-feature" type="button">-</button>
                    </div>
                `;
                container.appendChild(newInput);
            });

            // Adicionar recurso bloqueado
            document.querySelector('.add-feature-off').addEventListener('click', function () {
                const container = document.getElementById('features-off-container');
                const newInput = document.createElement('div');
                newInput.className = 'input-group';
                newInput.innerHTML = `
                    <input type="text" name="features_off[]" class="form-control" placeholder="Recurso bloqueado">
                    <div class="input-group-append">
                        <button class="btn btn-danger remove-feature-off" type="button">-</button>
                    </div>
                `;
                container.appendChild(newInput);
            });

            // Remover campos de recursos
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-feature')) {
                    e.target.closest('.input-group').remove();
                }
                if (e.target.classList.contains('remove-feature-off')) {
                    e.target.closest('.input-group').remove();
                }
            });
        });
    </script>
</body>
</html>