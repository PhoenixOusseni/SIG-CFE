<!DOCTYPE html>
<html lang="fr">

<head>
    @include('partials.meta')
    @yield('title')
    <title>SIG-CFE | Connexion</title>
    @yield('style')
    @include('partials.style')
    @notifyCss
    <style>
        :root {
            --primary-color: #2f663f;
            --primary-dark: #1e4429;
            --primary-light: #3d8050;
            --accent-color: #4ade80;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-overlay: rgba(255, 255, 255, 0.95);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #afbcf3 0%, #cfafee 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset('images/abstract.png') }}');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            z-index: 0;
        }

        .login-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-card {
            background: var(--bg-overlay);
            backdrop-filter: blur(20px);
            border-radius: 5px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            display: flex;
            flex-direction: row;
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .info-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            padding: 3rem;
            flex: 1;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .info-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .info-content {
            position: relative;
            z-index: 1;
        }

        .brand-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .brand-description {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            opacity: 0.95;
            text-align: center;
        }

        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .feature-text {
            font-size: 0.95rem;
            font-weight: 500;
        }

        .form-section {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: var(--text-light);
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 5px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 4px rgba(47, 102, 63, 0.1);
        }

        .remember-forgot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 0.5rem;
            cursor: pointer;
            accent-color: var(--primary-color);
        }

        .checkbox-label {
            font-size: 0.875rem;
            color: var(--text-dark);
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(47, 102, 63, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(47, 102, 63, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
            }

            .info-section {
                padding: 2rem;
            }

            .form-section {
                padding: 2rem;
            }

            .brand-title {
                font-size: 1.5rem;
            }

            .feature-text {
                font-size: 0.85rem;
            }
        }

        .inset-0 {
            z-index: 999999999 !important;
        }
    </style>
</head>

<body>
    @include('notify::components.notify')

    <div class="login-container">
        <div class="login-card">
            <!-- Section Information -->
            <div class="info-section">
                <div class="info-content">
                    <h1 class="brand-title">Bienvenue sur SIG-CFE</h1>
                    <p class="brand-description">
                        Un système de gestion informatisée moderne et efficace pour la facturation et le suivi budgétaire de votre entreprise.
                    </p>

                    <ul class="feature-list">
                        <li class="feature-item">
                            <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="feature-text">Gestion des diligences</span>
                        </li>
                        <li class="feature-item">
                            <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="feature-text">Gestion des factures</span>
                        </li>
                        <li class="feature-item">
                            <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="feature-text">Gestion des factures Fournisseur</span>
                        </li>
                        <li class="feature-item">
                            <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="feature-text">États des factures</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Section Formulaire -->
            <div class="form-section">
                <div class="form-header">
                    <h2 class="form-title">Connexion</h2>
                    <p class="form-subtitle">Accédez à votre espace de gestion</p>
                </div>

                <form method="POST" action="{{ route('auth') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="email">Adresse e-mail</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-input"
                                placeholder="votreemail@exemple.com"
                                required
                                autocomplete="email"
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Mot de passe</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-input"
                                placeholder="Entrez votre mot de passe"
                                required
                                autocomplete="current-password"
                            >
                        </div>
                    </div>

                    <div class="remember-forgot">
                        <div class="checkbox-wrapper">
                            <input
                                type="checkbox"
                                id="rememberMe"
                                name="remember"
                                value="true"
                            >
                            <label class="checkbox-label" for="rememberMe">
                                Se souvenir de moi
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        Se connecter
                    </button>
                </form>
            </div>
        </div>
    </div>

    @include('partials.script')
    @notifyJs
</body>

</html>
