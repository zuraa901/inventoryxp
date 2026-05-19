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

                .login-wrapper {
            width: 92%;
            max-width: 1350px;
            height: 90vh;
            background: #111827;
            border-radius: 40px;
            padding: 18px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        }

        .left-panel {
            width: 48%;
            background: white;
            border-radius: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .right-panel {
            width: 52%;
            position: relative;
            background: linear-gradient(
                135deg,
                #041b52,
                #0f3ca6,
                #2563eb
            );
            overflow: hidden;
        }

                .right-panel::before {
            content: "";
            position: absolute;
            width: 700px;
            height: 700px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
            top: -200px;
            right: -150px;
            filter: blur(20px);
        }

        .right-panel::after {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
            bottom: -150px;
            left: -120px;
            filter: blur(20px);
        }

        .right-content {
            position: relative;
            z-index: 2;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
        }

        .right-content h1 {
            font-size: 58px;
            margin-bottom: 16px;
            font-weight: bold;
        }

        .right-content p {
            font-size: 22px;
            opacity: 0.9;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 26px;
            padding: 40px 36px;
        }

        .form-group input:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 4px rgba(37,99,235,0.12);
        }

        .submit-btn:hover {
           transform: translateY(-2px);
            opacity: 0.95;
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
            border: 1px solid #e5e7eb;
            background: #f9fafb;
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
           background: linear-gradient(to right, #2563eb, #0f3ca6);
            transition: 0.3s;
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

        @media (max-width: 900px) {

            .login-wrapper {
                flex-direction: column;
                height: auto;
            }

            .right-panel {
                display: none;
            }

            .left-panel {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">

        <div class="left-panel">
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
        </div>

             <div class="right-panel">
               <div class="right-content">
                    <h1>InventoryXP</h1>
                    <p>Smart Inventory & Asset Management System</p>
                </div>
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