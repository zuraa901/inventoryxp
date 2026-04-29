<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - InventoryXP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f2f3f7;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-card {
            width: 100%;
            max-width: 490px;
            background: white;
            border-radius: 26px;
            padding: 40px 36px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.05);
        }

        .brand {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #041b52;
            margin-bottom: 26px;
        }

        .title {
            text-align: center;
            font-size: 58px;
            font-weight: bold;
            color: #041b52;
            margin-bottom: 14px;
        }

        .subtitle {
            text-align: center;
            font-size: 20px;
            color: #6b7280;
            margin-bottom: 42px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
            color: #111827;
        }

        .form-group input {
            width: 100%;
            height: 56px;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            padding: 0 16px;
            font-size: 16px;
            outline: none;
        }

        .password-wrap {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }

        .submit-btn {
            width: 100%;
            height: 58px;
            background: #041b52;
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
        }

        .bottom-text {
            text-align: center;
            margin-top: 26px;
            font-size: 17px;
            color: #111827;
        }

        .bottom-text a {
            color: #2563eb;
            text-decoration: none;
        }

        .bottom-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="brand">Asset System</div>
        <div class="title">Login</div>
        <div class="subtitle">Please login to continue</div>
            @if(session('success'))
                <div style="background:#e7f7ec; color:#1f7a3d; padding:12px; border-radius:8px; margin-bottom:16px;">
                {{ session('success') }}
                 </div>
            @endif

        @if(session('success'))
            <div style="background:#e7f7ec; color:#1f7a3d; padding:12px; border-radius:8px; margin-bottom:16px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#ffeaea; color:#b42318; padding:12px; border-radius:8px; margin-bottom:16px;">
                <ul style="margin-left:18px;">
                    @foreach($errors->all() as $error)
                 <li>{{ $error }}</li>
                     @endforeach
                </ul>
            </div>
        @endif

        <form action="/login/check" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrap">
                    <input type="password" id="password" name="password">
                    <button type="button" class="toggle-password" onclick="togglePassword('password', this)">👁️</button>
                </div>
            </div>

            <button type="submit" class="submit-btn">Login</button>
        </form>

        <div class="bottom-text">
            Don’t have an account? <a href="/register">Register</a>
        </div>
    </div>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>