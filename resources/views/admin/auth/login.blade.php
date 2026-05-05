<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login · Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 400px;
        }

        .login-brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-brand-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            box-shadow: 0 8px 20px rgba(249, 115, 22, 0.28);
        }

        .login-brand-icon i { font-size: 22px; color: #fff; }

        .login-brand h1 {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.3px;
        }

        .login-brand p {
            font-size: 13px;
            color: #64748b;
            margin-top: 3px;
        }

        .login-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.05);
        }

        .login-card h2 {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 22px;
        }

        .form-group { margin-bottom: 14px; }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 13px;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 10px 13px 10px 38px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            background: #ffffff;
            transition: border-color 0.15s, box-shadow 0.15s;
            outline: none;
        }

        .form-input:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }

        .form-input::placeholder { color: #9ca3af; }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            margin-top: 4px;
        }

        .remember-row input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: #f97316;
            cursor: pointer;
        }

        .remember-row label {
            font-size: 13px;
            color: #6b7280;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 11px;
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
        }

        .btn-login:hover { opacity: 0.92; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); opacity: 1; }

        .alert {
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
        }

        .alert ul { margin: 0; padding-left: 16px; }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-brand">
            <div class="login-brand-icon">
                <i class="fas fa-university"></i>
            </div>
            <h1>Magister Teknik Sipil</h1>
            <p>Universitas Mulawarman</p>
        </div>

        <div class="login-card">
            <h2>Masuk ke Admin Panel</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.attempt') }}" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-wrap">
                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                        <input class="form-input" type="email" name="email" id="email"
                            placeholder="admin@example.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrap">
                        <span class="input-icon"><i class="fas fa-lock"></i></span>
                        <input class="form-input" type="password" name="password" id="password"
                            placeholder="••••••••" required>
                    </div>
                </div>
                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label for="remember">Ingat saya</label>
                </div>
                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>

        <div class="login-footer">
            @if(\App\Models\User::query()->exists())
                Akun admin sudah tersedia.
            @else
                Pembuatan akun admin hanya bisa dilakukan oleh developer.
            @endif
        </div>
    </div>
</body>
</html>
