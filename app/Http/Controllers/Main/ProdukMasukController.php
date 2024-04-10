<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProdukMasukController extends Controller
{
    public function index()
    {
        return view('main.produk-masuk.index');
    }

    public function render()
    {
        $produk = ProdukMasuk::with(['supplier'])->get();

        $view = [
            'data' => view('main.produk-masuk.render', compact('produk'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $supplier = Supplier::where('status', true)->get();
        $view = [
            'data' => view('main.produk-masuk.create', compact('supplier'))->render(),
        ];

        return response()->json($view);
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'supplier_id' => $request->supplier_id,
                'data' => json_encode(json_decode($request->list_produk, true)[0]['data']),
                'tanggal_proses' => date_format(date_create($request->tanggal_proses), 'Y-m-d'),
            ];

            foreach (json_decode($request->list_produk, true)[0]['data'] as $key => $value) {
                $produk = Produk::find($value['produkId']);
                $produk->update([
                    'stok' => $produk->stok + (int)$value['jumlah']
                ]);
            }

            ProdukMasuk::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $produk = ProdukMasuk::find($id);
        $supplier = Supplier::all();
        $view = [
            'data' => view('main.produk-masuk.edit', compact(['supplier', 'produk']))->render(),
            'produk' => json_decode($produk->data, true)
        ];

        return response()->json($view);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        try {
            $produkMasuk = ProdukMasuk::find($request->produk_masuk_id);
            // dd($request->all());
            $data = [
                // 'supplier_id' => $request->supplier_id,
                'data' => json_encode(json_decode($request->list_produk, true)[0]['data']),
                'tanggal_proses' => date_format(date_create($request->tanggal_proses), 'Y-m-d'),
            ];

            // update ++ stok
            foreach (json_decode($produkMasuk->data, true) as $key => $value) {
                $produk = Produk::find($value['produkId']);
                $produk->update([
                    'stok' => $produk->stok - (int)$value['jumlah']
                ]);
            }

            // update -- stok
            foreach (json_decode($request->list_produk, true)[0]['data'] as $key => $value) {
                $produk = Produk::find($value['produkId']);
                $produk->update([
                    'stok' => $produk->stok + (int)$value['jumlah']
                ]);
            }

            $produkMasuk->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function listProduk()
    {
        $produk = Produk::where('status', true)
                        ->get();

        return response()->json($produk);
    }

    public function dataMasuk($id) {
        $produkMasuk = ProdukMasuk::find($id);

        return response()->json(json_decode($produkMasuk->data, true));
    }
}
