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

        .add-btn {
            display: inline-block;
            background: #2878ff;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            margin-bottom: 22px;
            font-size: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background: #1f252d;
            color: white;
        }

        th, td {
            padding: 14px 10px;
            border: 1px solid #d1d5db;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
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

        .action-cell {
    position: relative;
    width: 70px;
        }

        .row-menu-trigger {
            background: none;
            border: none;
            font-size: 22px;
            cursor: pointer;
            display: none;
            color: #1f252d;
            padding: 4px 8px;
            border-radius: 6px;
        }

        tbody tr:hover .row-menu-trigger {
            display: inline-block;
        }

        .row-menu {
            position: absolute;
            top: 40px;
            left: 10px;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            min-width: 130px;
            display: none;
            z-index: 2000;
        }

        .row-menu.active {
            display: block;
        }

        .row-menu button {
            width: 100%;
            background: none;
            border: none;
            text-align: left;
            padding: 10px 14px;
            cursor: pointer;
            font-size: 14px;
        }

        .row-menu button:hover {
            background: #f3f4f6;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            display: none;
            justify-content: center;
            align-items: center;
            padding: 20px;
            z-index: 999;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-box {
            background: #fff;
            width: 100%;
            max-width: 760px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.18);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 28px;
            border-bottom: 1px solid #ddd;
        }

        .modal-header h3 {
            font-size: 22px;
            font-weight: normal;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 28px;
            color: #777;
            cursor: pointer;
        }

        .modal-body {
            padding: 26px 28px 18px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d5dbe1;
            border-radius: 10px;
            font-size: 16px;
        }

        .modal-footer {
            border-top: 1px solid #ddd;
            padding: 18px 28px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 18px;
            cursor: pointer;
        }

        .btn-save {
            background: #198754;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 18px;
            cursor: pointer;
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

        <div class="main" id="main">
            <div class="topbar">
                <div class="topbar-left">
                    <button class="toggle-btn" onclick="openSidebar()">☰</button>
                    <div class="topbar-title">Inventory</div>
                </div>
                    <div class="topbar-right">
                        Welcome, {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                    </div>
                </div>

            <div class="content-card">
                <h3>Inventory Data</h3>

                @if(session('success'))
                    <div style="background:#e7f7ec; color:#1f7a3d; padding:12px 16px; border-radius:8px; margin-bottom:16px;">
                        {{ session('success') }}
                    </div>
                @endif

                <button type="button" onclick="openModal()" style="background:#2f80ff; color:white; border:none; padding:10px 16px; border-radius:8px; cursor:pointer; margin-bottom:16px;">
                    + Tambah Barang
                </button>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->kode_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->jenis_barang }}</td>
                                <td>{{ $item->stok }}</td>

                                <td class="action-cell">
                                    <button type="button"
                                        class="row-menu-trigger"
                                        onclick="toggleMenu(event, 'menu-{{ $item->id }}')">⋮</button>

                                        <div class="row-menu" id="menu-{{ $item->id }}">
                                            <button type="button"
                                                onclick="openEditModal(
                                                    '{{ $item->id }}',
                                                    '{{ $item->kode_barang }}',
                                                    '{{ $item->nama_barang }}',
                                                    '{{ $item->jenis_barang }}',
                                                    '{{ $item->stok }}'
                                                )">
                                                Update
                                    </button>

                                            <form action="/inventory/delete/{{ $item->id }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                @csrf
                                                <button type="submit">Delete</button>
                                            </form>
                                        </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No inventory data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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

        <div id="modalOverlay" style="position:fixed; inset:0; background:rgba(0,0,0,0.45); display:{{ $errors->any() ? 'flex' : 'none' }}; justify-content:center; align-items:center; padding:20px; z-index:999;">
    <div style="background:#fff; width:100%; max-width:760px; border-radius:16px; overflow:hidden; box-shadow:0 8px 24px rgba(0,0,0,0.18);">
        
        <div style="display:flex; justify-content:space-between; align-items:center; padding:22px 28px; border-bottom:1px solid #ddd;">
            <h3 style="font-size:22px; font-weight:normal;">Tambah Inventory</h3>
            <button type="button" onclick="closeModal()" style="background:none; border:none; font-size:28px; color:#777; cursor:pointer;">&times;</button>
        </div>

        <form action="/inventory/store" method="POST">
            @csrf

            <div style="padding:26px 28px 18px;">
                @if($errors->any())
                    <div style="background:#ffeaea; color:#b42318; padding:12px 16px; border-radius:8px; margin-bottom:18px;">
                        <ul style="margin-left:18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div style="margin-bottom:22px;">
                    <label for="kode_barang" style="display:block; margin-bottom:10px;">Kode Barang</label>
                    <input type="text" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}" style="width:100%; padding:14px 16px; border:1px solid #d5dbe1; border-radius:10px;">
                </div>

                <div style="margin-bottom:22px;">
                    <label for="nama_barang" style="display:block; margin-bottom:10px;">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" style="width:100%; padding:14px 16px; border:1px solid #d5dbe1; border-radius:10px;">
                </div>

                <div style="margin-bottom:22px;">
                    <label for="jenis_barang" style="display:block; margin-bottom:10px;">Jenis Barang</label>
                    <input type="text" id="jenis_barang" name="jenis_barang" value="{{ old('jenis_barang') }}" style="width:100%; padding:14px 16px; border:1px solid #d5dbe1; border-radius:10px;">
                </div>

                <div style="margin-bottom:22px;">
                    <label for="stok" style="display:block; margin-bottom:10px;">Stok</label>
                    <input type="number" id="stok" name="stok" value="{{ old('stok') }}" style="width:100%; padding:14px 16px; border:1px solid #d5dbe1; border-radius:10px;">
                </div>
            </div>

            <div style="border-top:1px solid #ddd; padding:18px 28px; display:flex; justify-content:flex-end; gap:12px;">
                <button type="button" onclick="closeModal()" style="background:#6c757d; color:white; border:none; border-radius:8px; padding:12px 18px; cursor:pointer;">Batal</button>
                <button type="submit" style="background:#198754; color:white; border:none; border-radius:8px; padding:12px 18px; cursor:pointer;">Simpan</button>
            </div>
        </form>
    </div>
</div>

    <div class="modal-overlay" id="editModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Update Inventory</h3>
                <button type="button" class="close-btn" onclick="closeEditModal()">&times;</button>
            </div>

            <form id="editForm" method="POST" onsubmit="return confirm('Update this data?');">
                @csrf

                <div class="modal-body">

                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" id="edit_kode_barang" name="kode_barang">
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" id="edit_nama_barang" name="nama_barang">
                    </div>

                    <div class="form-group">
                        <label>Jenis</label>
                        <input type="text" id="edit_jenis_barang" name="jenis_barang">
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" id="edit_stok" name="stok">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openModal() {
        document.getElementById('modalOverlay').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('modalOverlay').style.display = 'none';
    }

    function toggleMenu(event, menuId) {
        event.stopPropagation();

        document.querySelectorAll('.row-menu').forEach(menu => {
            if (menu.id !== menuId) {
                menu.classList.remove('active');
            }
        });

        document.getElementById(menuId).classList.toggle('active');
    }

    document.addEventListener('click', function () {
        document.querySelectorAll('.row-menu').forEach(menu => {
            menu.classList.remove('active');
        });
    });

    function openEditModal(id, kode, nama, jenis, stok) {
        document.getElementById('editForm').action = '/inventory/update/' + id;
        document.getElementById('edit_kode_barang').value = kode;
        document.getElementById('edit_nama_barang').value = nama;
        document.getElementById('edit_jenis_barang').value = jenis;
        document.getElementById('edit_stok').value = stok;

        document.getElementById('editModal').classList.add('active');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
    }
</script>

</body>
</html>