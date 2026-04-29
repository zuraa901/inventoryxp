    <?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    use App\Models\Inventory;
    use App\Models\Asset;
    use App\Models\AssetHandover;
    use App\Models\User;
    use App\Models\History;

    /*
    |--------------------------------------------------------------------------
    | Inventory
    |--------------------------------------------------------------------------
    */
        Route::get('/', function () {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $items = Inventory::all();
       
        return response()
        ->view('inventory', compact('items'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    });

    Route::post('/inventory/store', function (Request $request) {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'stok' => 'required|integer',
        ]);

        $item = Inventory::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'stok' => $request->stok,
        ]);

        History::create([
            'user_name' => Auth::check() ? Auth::user()->name : 'Guest',
            'activity' => 'Add Inventory',
            'target_type' => 'Inventory',
            'target_name' => $item->nama_barang,
            'description' => 'Added inventory: ' . $item->nama_barang,
        ]);

        return redirect('/')->with('success', 'Barang berhasil ditambahkan!');
    });

    Route::post('/inventory/update/{id}', function (Request $request, $id) {
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'stok' => 'required|integer',
        ]);

       $item = Inventory::findOrFail($id);
        $oldName = $item->nama_barang;
        $oldStok = $item->stok;

        $item->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'stok' => $request->stok,
        ]);

        History::create([
            'user_name' => Auth::check() ? Auth::user()->name : 'Guest',
            'activity' => 'Update Inventory',
            'target_type' => 'Inventory',
            'target_name' => $request->nama_barang,
            'description' => 'Updated inventory: ' . $oldName . ' | Stok: ' . $oldStok . ' → ' . $request->stok,
        ]);

        return redirect('/')->with('success', 'Inventory berhasil diupdate!');
    });

    Route::post('/inventory/delete/{id}', function ($id) {
        $item = Inventory::findOrFail($id);
        $itemName = $item->nama_barang;

        $item->delete();

        History::create([
            'user_name' => Auth::check() ? Auth::user()->name : 'Guest',
            'activity' => 'Delete Inventory',
            'target_type' => 'Inventory',
            'target_name' => $itemName,
            'description' => 'Deleted inventory: ' . $itemName,
        ]);

        return redirect('/')->with('success', 'Inventory berhasil dihapus!');
    });

    /*
    |--------------------------------------------------------------------------
    | Asset
    |--------------------------------------------------------------------------
    */

   Route::get('/asset', function () {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $assets = Asset::all();
        
        return response()
        ->view('asset', compact('assets'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        });

    Route::post('/asset/store', function (Request $request) {
        $request->validate([
            'kode_asset' => 'required',
            'nama_asset' => 'required',
            'status' => 'required',
            'lokasi' => 'required',
        ]);

        $asset = Asset::create([
            'kode_asset' => $request->kode_asset,
            'nama_asset' => $request->nama_asset,
            'status' => $request->status,
            'lokasi' => $request->lokasi,
        ]);

        History::create([
            'user_name' => Auth::check() ? Auth::user()->name : 'Guest',
            'activity' => 'Add Asset',
            'target_type' => 'Asset',
            'target_name' => $asset->nama_asset,
            'description' => 'Added asset: ' . $asset->nama_asset,
        ]);

        return redirect('/asset')->with('success', 'Asset berhasil ditambahkan!');
    });

    Route::post('/asset/update/{id}', function (Request $request, $id) {
        $request->validate([
            'kode_asset' => 'required',
            'nama_asset' => 'required',
            'status' => 'required',
            'lokasi' => 'required',
        ]);

        $asset = Asset::findOrFail($id);
            $oldName = $asset->nama_asset;
            $oldStatus = $asset->status;
            $oldLokasi = $asset->lokasi;

            $asset->update([
                'kode_asset' => $request->kode_asset,
                'nama_asset' => $request->nama_asset,
                'status' => $request->status,
                'lokasi' => $request->lokasi,
            ]);

            History::create([
                'user_name' => Auth::check() ? Auth::user()->name : 'Guest',
                'activity' => 'Update Asset',
                'target_type' => 'Asset',
                'target_name' => $asset->nama_asset,
                'description' => 'Updated asset: ' . $oldName . ' | Status: ' . $oldStatus . ' → ' . $request->status . ' | Lokasi: ' . $oldLokasi . ' → ' . $request->lokasi,
            ]);

        return redirect('/asset')->with('success', 'Asset berhasil diupdate!');
    });

    Route::post('/asset/delete/{id}', function ($id) {
        $asset = Asset::findOrFail($id);
        $assetName = $asset->nama_asset;

        $asset->delete();

        History::create([
            'user_name' => Auth::check() ? Auth::user()->name : 'Guest',
            'activity' => 'Delete Asset',
            'target_type' => 'Asset',
            'target_name' => $assetName,
            'description' => 'Deleted asset: ' . $assetName,
        ]);
        return redirect('/asset')->with('success', 'Asset berhasil dihapus!');
    });

    /*
    |--------------------------------------------------------------------------
    | Handover
    |--------------------------------------------------------------------------
    */

    Route::get('/handover', function () {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $assets = Asset::all();
        
        return response()
        ->view('handover', compact('assets'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        });
    Route::post('/handover/store', function (Request $request) {
        $request->validate([
            'asset_id' => 'required',
            'penerima' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required|date',
        ]);

        $handover = AssetHandover::create([
            'asset_id' => $request->asset_id,
            'penerima' => $request->penerima,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
        ]);

        $asset = Asset::find($request->asset_id);

        History::create([
            'user_name' => Auth::check() ? Auth::user()->name : 'Guest',
            'activity' => 'Handover Asset',
            'target_type' => 'Handover',
            'target_name' => $asset ? $asset->nama_asset : 'Unknown Asset',
            'description' => 'Asset handed over to ' . $request->penerima . ' at ' . $request->lokasi . ' on ' . $request->tanggal,
        ]);

        return redirect('/handover')->with('success', 'Data penyerahan asset berhasil disimpan!');
    });

    /*
    |--------------------------------------------------------------------------
    | Auth - Register & Login
    |--------------------------------------------------------------------------
    */

   Route::get('/login', function () {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.login');
    });

    Route::get('/register', function () {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register');
    });

    Route::post('/register/store', function (Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect('/login')->with('success', 'Register berhasil! Silakan login.');
    });

    Route::post('/login/check', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    });

    /*
    |--------------------------------------------------------------------------
    | History
    |--------------------------------------------------------------------------
    */

    Route::get('/history', function () {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $histories = History::orderBy('created_at', 'desc')->get();
        
        return response()
        ->view('history', compact('histories'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        });

    /*
    |--------------------------------------------------------------------------
    | logout
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', function (Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    });