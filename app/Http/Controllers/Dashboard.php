<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index', [
            'transaksi' => Transaksi::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.create', [
            'databarang' => Barang::select('nama_barang')->distinct()->get()
        ]);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user = auth()->user();
            $notrx = 'TRX' . date('Y') . Str::random(10) . date('dm');

            // Simpan transaksi
            $trx = new Transaksi();
            $trx->no_transaksi = $notrx;
            $trx->nama_pengajuan = $request->nama_pengajuan;
            $trx->nama_admin = $user->name;
            $trx->quantity = $request->quantity_total;
            $trx->id_user = $user->id;
            $trx->save();

            foreach ($request->input('kode_produksi') as $key => $value) {
                // Kurangi stok barang di database
                $barang = Barang::where('kode_produksi', $value)->first();
                $barang->quantity -= $request->input('quantity')[$key];
                $barang->save();

                // Simpan Detail transaksi
                $dtltrx = new DetailTransaksi();
                $dtltrx->no_transaksi = $notrx;
                $dtltrx->kode_produksi = $request->input('kode_produksi')[$key];
                $dtltrx->grade = $request->input('grade')[$key];
                $dtltrx->quantity = $request->input('quantity')[$key];
                $dtltrx->expired_at = $request->input('expired_at')[$key];
                $dtltrx->save();
            }
        });

        return back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $barangName = $request->input('barang_name');
        $requestQuantity = $request->input('request_quantity');

        // Ambil data barang dari database berdasarkan nama barang
        $barangs = Barang::where('nama_barang', $barangName)
            ->orderByRaw("expired_at > NOW()") // Pilih yang expired lebih dekat dengan hari ini
            ->orderBy('expired_at', 'asc')
            ->orderBy('grade', 'asc') // Pilih yang memiliki grade lebih tinggi
            ->get();

        // Logika pemilihan barang sesuai dengan jumlah request
        $remainingQuantity = $requestQuantity;
        $selectedBarangs = [];

        foreach ($barangs as $barang) {
            $quantityToTake = min($remainingQuantity, $barang->quantity);

            // $expiredbarang = Carbon::parse($barang->expired_at)->format('d F Y');
            if ($quantityToTake > 0) {
                // Simpan barang yang telah dipilih tanpa mengurangi quantity di database
                $selectedBarangs[] = [
                    'kode_produksi' => $barang->kode_produksi,
                    'nama_barang' => $barang->nama_barang,
                    'grade' => $barang->grade,
                    'quantity' => $quantityToTake,
                    'expired_at' => $barang->expired_at,
                ];

                $remainingQuantity -= $quantityToTake;
            }
            // Hentikan iterasi jika jumlah request sudah terpenuhi
            if ($remainingQuantity <= 0) {
                break;
            }
        }

        // Kembalikan hasil sebagai respons JSON
        return response()->json($selectedBarangs);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
