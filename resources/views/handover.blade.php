<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InventoryXP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #111827;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: #03184a;
            color: white;
            padding: 24px 20px;
            position: fixed;
            top: 0;
            left: -260px;
            height: 100%;
            transition: 0.3s ease;
            z-index: 1000;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar .menu-btn {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            background: rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 40px;
            font-weight: normal;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            font-size: 18px;
            margin: 28px 0;
        }

        .main {
            flex: 1;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        .topbar {
            margin: 18px;
            background: white;
            border-radius: 18px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .toggle-btn {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #1e2b45;
            color: white;
            border: none;
            font-size: 28px;
            cursor: pointer;
        }

        .topbar-title {
            font-size: 22px;
            font-weight: 500;
        }

        .topbar-right {
            font-size: 16px;
            color: #111827;
        }

        .content-card {
            margin: 18px;
            background: #efefef;
            border-radius: 18px;
            padding: 24px 22px;
            min-height: 520px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .content-card h3 {
            font-size: 20px;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.2);
            display: none;
            z-index: 900;
        }

        .overlay.active {
            display: block;
        }

        .success-box {
            background: #e7f7ec;
            color: #1f7a3d;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .error-box {
            background: #ffeaea;
            color: #b42318;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        .submit-btn {
            background: #198754;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }

        @media (min-width: 992px) {
            .sidebar.active + .main {
                margin-left: 260px;
            }
        }
    </style>
</head>
<body>

    <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

    <div class="layout">
        <div class="sidebar" id="sidebar">
            <div class="menu-btn" onclick="closeSidebar()">☰</div>
            <h2>InventoryXP</h2>

            <a href="#">Dashboard</a>
            <a href="/">Inventory</a>
            <a href="/asset">Assets</a>
            <a href="/handover">Handover</a>
            <a href="/history">History</a>
            <form action="/logout" method="POST" style="margin: 28px 0;">
                @csrf
                <button type="submit" style="background:none; border:none; color:white; font-size:18px; cursor:pointer; padding:0;">
                    Logout
                </button>
            </form>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="topbar-left">
                    <button class="toggle-btn" onclick="openSidebar()">☰</button>
                    <div class="topbar-title">Handover</div>
                </div>
                <div class="topbar-right">
                    Welcome, {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                </div>
            </div>

            <div class="content-card">
                <h3>Form Penyerahan Asset</h3>

                @if(session('success'))
                    <div class="success-box">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="error-box">
                        <ul style="margin-left:18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/handover/store" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="asset_id">Pilih Asset</label>
                        <select name="asset_id" id="asset_id">
                            <option value="">-- Pilih Asset --</option>
                            @foreach ($assets as $asset)
                                <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                    {{ $asset->kode_asset }} - {{ $asset->nama_asset }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="penerima">Penerima</label>
                        <input type="text" name="penerima" id="penerima" value="{{ old('penerima') }}">
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi Tujuan</label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}">
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
                    </div>

                    <button type="submit" class="submit-btn">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.add('active');
            document.getElementById('overlay').classList.add('active');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        }
    </script>

</body>
</html>