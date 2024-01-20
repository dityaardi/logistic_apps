<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang.index', [
            'databarang' => Barang::where('quantity', '>', 0)->orderby('nama_barang', 'ASC')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'grade' => 'required|string',
            'quantity' => 'required|numeric|integer',
            'expired_at' => 'required'
        ]);

        $kodebarang = 'BRG' . date('Y') . Str::random(10) . date('dm');

        $create = new Barang();
        $create->kode_produksi = $kodebarang;
        $create->nama_barang = $request->nama_barang;
        $create->grade = $request->grade;
        $create->quantity = $request->quantity;
        $create->expired_at = $request->expired_at;
        $create->save();

        return redirect('/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $idbarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $id_barang)
    {
        // return view('barang.index',[
        //     'databarang' => Barang::all()->where('id_barang', $id_barang)
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idbarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_barang)
    {
        $data = Barang::find($id_barang);
        $data->delete();

        return redirect('/barang');
    }
}
