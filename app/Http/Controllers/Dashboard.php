<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index', [
            'databarang' => Barang::select('nama_barang')->distinct()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

            $expiredbarang = Carbon::parse($barang->expired_at)->format('d F Y');

            // Simpan barang yang telah dipilih tanpa mengurangi quantity di database
            $selectedBarangs[] = [
                'nama_barang' => $barang->nama_barang,
                'grade' => $barang->grade,
                'quantity' => $quantityToTake,
                'expired_at' => $expiredbarang,
            ];

            $remainingQuantity -= $quantityToTake;

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
