<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Profile</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bundy.net/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --danger: #ef4444;
            --success: #10b981;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --text-light: #1e293b;
            --text-dark: #f8fafc;
            --bg-light: #ffffff;
            --bg-dark: #0f172a;
            --card-light: #ffffff;
            --card-dark: #1e293b;
            --border-light: #e2e8f0;
            --border-dark: #334155;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: background-color 0.3s ease, color 0.3s ease;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        body.dark-mode {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .profile-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .profile-header h1 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .profile-header p {
            color: var(--gray-300);
        }

        .profile-section {
            background-color: var(--card-light);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 2rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-light);
            transition: all 0.3s ease;
        }

        .dark-mode .profile-section {
            background-color: var(--card-dark);
            border-color: var(--border-dark);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.25), 0 2px 4px -1px rgba(0, 0, 0, 0.15);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: inherit;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border-light);
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: all 0.3s ease;
        }

        .dark-mode .form-input {
            background-color: var(--gray-800);
            border-color: var(--border-dark);
            color: var(--text-dark);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--border-light);
            color: inherit;
        }

        .dark-mode .btn-outline {
            border-color: var(--border-dark);
        }

        .btn-outline:hover {
            background-color: rgba(99, 102, 241, 0.1);
            border-color: var(--primary);
        }

        .text-success {
            color: var(--success);
        }

        .text-muted {
            color: var(--gray-300);
            font-size: 0.875rem;
        }

        .flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .items-center {
            align-items: center;
        }

        .gap-4 {
            gap: 1rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .max-w-xl {
            max-width: 36rem;
        }

        .w-full {
            width: 95%;
        }

        /* Toggle switch for dark mode */
        .theme-toggle {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 100;
        }

        .theme-toggle-btn {
            background-color: var(--card-light);
            border: 1px solid var(--border-light);
            border-radius: 2rem;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dark-mode .theme-toggle-btn {
            background-color: var(--card-dark);
            border-color: var(--border-dark);
        }

        .theme-toggle-btn i {
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .theme-toggle-btn .fa-sun {
            color: #f59e0b;
        }

        .theme-toggle-btn .fa-moon {
            color: #6366f1;
        }
    </style>
</head>
<body class="{{ request()->cookie('theme', 'dark') === 'dark' ? 'dark-mode' : '' }}">
    <!-- Theme Toggle -->
    <div class="theme-toggle">
        <button class="theme-toggle-btn" id="theme-toggle">
            <i class="fas fa-sun"></i>
            <i class="fas fa-moon"></i>
        </button>
    </div>

    <div class="profile-container">
        <div class="profile-header">

            <a href="{{ route('admin.dashboard') }}" style="text-decoration:none"><h1 >Voltar</h1></a>
            <p>User Profile</p>
        </div>

        <div class=" mx-auto">
            <!-- Update Profile Information -->
            <div class="profile-section">
                <h2 class="section-title">
                    <i class="fas fa-user-circle"></i>
                    Profile Information
                </h2>
                
                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <input id="name" name="name" type="text" class="form-input w-full" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        @error('name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-input w-full" value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>

                        @if (session('status') === 'profile-updated')
                            <p class="text-success">
                                <i class="fas fa-check-circle"></i> Saved.
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Update Password -->
            <div class="profile-section">
                <h2 class="section-title">
                    <i class="fas fa-lock"></i>
                    Update Password
                </h2>
                
                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label class="form-label" for="current_password">Current Password</label>
                        <input id="current_password" name="current_password" type="password" class="form-input w-full" autocomplete="current-password">
                        @error('current_password')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">New Password</label>
                        <input id="password" name="password" type="password" class="form-input w-full" autocomplete="new-password">
                        @error('password')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-input w-full" autocomplete="new-password">
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key"></i> Update Password
                        </button>

                        @if (session('status') === 'password-updated')
                            <p class="text-success">
                                <i class="fas fa-check-circle"></i> Password updated.
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Delete Account -->
            
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <!-- Scripts -->
    <script>
        // Theme toggle functionality
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            document.cookie = `theme=${isDarkMode ? 'dark' : 'light'}; path=/; max-age=${60*60*24*365}`;
        });

        // Dialog polyfill for older browsers
        if (typeof HTMLDialogElement !== 'function') {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/dialog-polyfill@0.5.6/dist/dialog-polyfill.min.js';
            script.onload = function() {
                document.querySelectorAll('dialog').forEach(dialog => {
                    dialogPolyfill.registerDialog(dialog);
                });
            };
            document.head.appendChild(script);
        }
    </script>
</body>
</html>