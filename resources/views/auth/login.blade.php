<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InventoryXP</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial,sans-serif;
        }

        body{
            background:#f2f3f7;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .container{
            width:92%;
            max-width:1350px;
            height:90vh;
            background:#111827;
            border-radius:40px;
            overflow:hidden;
            display:flex;
            box-shadow:0 15px 40px rgba(0,0,0,0.25);
        }

        .left{
            width:50%;
            background:white;
            display:flex;
            justify-content:center;
            align-items:center;
            position:relative;
            overflow:hidden;
        }

        .right{
            width:50%;
            background:linear-gradient(
                135deg,
                #041b52,
                #0f3ca6,
                #2563eb
            );
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            text-align:center;
            padding:40px;
        }

        .right h1{
            font-size:60px;
            margin-bottom:16px;
        }

        .right p{
            font-size:22px;
            opacity:0.9;
        }

        .form-box{
            width:100%;
            max-width:420px;
            position:absolute;
            transition:0.5s;
        }

        .login-form{
            left:50%;
            transform:translateX(-50%);
        }

        .register-form{
            left:150%;
            transform:translateX(-50%);
        }

        .container.active .login-form{
            left:-100%;
        }

        .container.active .register-form{
            left:50%;
        }

        .brand{
            text-align:center;
            font-size:28px;
            font-weight:bold;
            color:#041b52;
            margin-bottom:20px;
        }

        .title{
            text-align:center;
            font-size:58px;
            font-weight:bold;
            color:#041b52;
            margin-bottom:10px;
        }

        .subtitle{
            text-align:center;
            font-size:18px;
            color:#6b7280;
            margin-bottom:30px;
        }

        .switch{
            position: relative;
            width:100%;
            height:58px;
            background:#f3f4f6;
            border-radius:40px;
            display:flex;
            align-items:center;
            margin-bottom:30px;
            overflow:hidden;
        }

        .slider{
            position:absolute;
            width:50%;
            height:100%;
            background:linear-gradient(to right,#2563eb,#0f3ca6);
            border-radius:40px;
            top:0;
            transition:0.4s ease;
        }

        .login-switch .slider{
                left:0;
            }

            .register-switch .slider{
                left:50%;
            }

        .switch button{
            flex:1;
            height:100%;
            border:none;
            background:none;
            cursor:pointer;
            font-size:16px;
            font-weight:bold;
            z-index:2;
            color:#111827;
            transition:0.3s;
        }

        .switch button.active-text{
            color:white;
        }

        .form-group{
            margin-bottom:20px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            font-size:17px;
        }

        .form-group input{
            width:100%;
            height:56px;
            border:1px solid #e5e7eb;
            background:#f9fafb;
            border-radius:14px;
            padding:0 16px;
            font-size:16px;
            outline:none;
        }

        .form-group input:focus{
            border-color:#2563eb;
            background:white;
            box-shadow:0 0 0 4px rgba(37,99,235,0.12);
        }

        .password-wrap{
            position:relative;
        }

        .toggle-password{
            position:absolute;
            right:14px;
            top:50%;
            transform:translateY(-50%);
            border:none;
            background:none;
            cursor:pointer;
        }

        .submit-btn{
            width:100%;
            height:58px;
            border:none;
            border-radius:14px;
            background:linear-gradient(to right,#2563eb,#0f3ca6);
            color:white;
            font-size:20px;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
            margin-top:10px;
        }

        .submit-btn:hover{
            transform:translateY(-2px);
        }

        @media(max-width:900px){

            .container{
                flex-direction:column;
                height:auto;
            }

            .right{
                display:none;
            }

            .left{
                width:100%;
                padding:60px 0;
            }

            .form-box{
                position:relative;
                left:auto !important;
                transform:none !important;
                margin:auto;
            }

            .register-form{
                display:none;
            }

            .container.active .login-form{
                display:none;
            }

            .container.active .register-form{
                display:block;
            }
        }

    </style>
</head>

<body>

<div class="container" id="container">

    <div class="left">

        <!-- LOGIN -->
        <div class="form-box login-form">

            <div class="brand">InventoryXP</div>
            <div class="title">Login</div>
            <div class="subtitle">Please login to continue</div>

           <div class="switch">

                <div class="slider" id="slider"></div>

                <button class="active-text" id="loginBtn"
                onclick="showLogin()">
                    Sign In
                </button>

                <button id="registerBtn"
                onclick="showRegister()">
                    Sign Up
                </button>

            </div>

            <form action="/login/check" method="POST">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>

                <div class="form-group">
                    <label>Password</label>

                    <div class="password-wrap">
                        <input type="password" id="loginPassword" name="password">

                        <button type="button"
                        class="toggle-password"
                        onclick="togglePassword('loginPassword')">
                            👁️
                        </button>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    Login
                </button>

            </form>

        </div>

        <!-- REGISTER -->
        <div class="form-box register-form">

            <div class="brand">InventoryXP</div>
            <div class="title">Register</div>
            <div class="subtitle">Create your account first</div>

            <div class="switch register-switch">

                <div class="slider"></div>

                <button onclick="showLogin()">
                    Sign In
                </button>

                <button class="active-text">
                    Sign Up
                </button>

            </div>
           
            <form action="/register/store" method="POST">
                @csrf

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>

                <div class="form-group">
                    <label>Password</label>

                    <div class="password-wrap">
                        <input type="password" id="registerPassword" name="password">

                        <button type="button"
                        class="toggle-password"
                        onclick="togglePassword('registerPassword')">
                            👁️
                        </button>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    Register
                </button>

            </form>

        </div>

    </div>

    <div class="right">
        <div>
            <h1>InventoryXP</h1>
            <p>Smart Inventory & Asset Management System</p>
        </div>
    </div>

</div>

<script>
    const container = document.getElementById("container");

const slider = document.getElementById("slider");

const loginBtn = document.getElementById("loginBtn");

const registerBtn = document.getElementById("registerBtn");

function showRegister(){

    container.classList.add("active");

    slider.style.left = "50%";

    loginBtn.classList.remove("active-text");

    registerBtn.classList.add("active-text");
}

function showLogin(){

    container.classList.remove("active");

    slider.style.left = "0";

    loginBtn.classList.add("active-text");

    registerBtn.classList.remove("active-text");
}

function togglePassword(id){

    const input = document.getElementById(id);

    input.type =
    input.type === "password"
    ? "text"
    : "password";
}
    
    

</script>

</body>
</html>