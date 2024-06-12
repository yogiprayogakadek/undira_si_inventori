<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukOutRequest;
use App\Models\Produk;
use App\Models\ProdukKeluar;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProdukKeluarController extends Controller
{
    public function index()
    {
        return view('main.produk-keluar.index');
    }

    public function render()
    {
        $produk = ProdukKeluar::all();

        $view = [
            'data' => view('main.produk-keluar.render', compact('produk'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $supplier = Supplier::where('status', true)->get();
        $view = [
            'data' => view('main.produk-keluar.create', compact('supplier'))->render(),
        ];

        return response()->json($view);
    }

    public function store(Request $request)
    {
        try {
            $data = [
                // 'supplier_id' => $request->supplier_id,
                'data' => json_encode(json_decode($request->list_produk, true)[0]['data']),
                'tanggal_proses' => date_format(date_create($request->tanggal_proses), 'Y-m-d'),
                'nama_customer' => $request->nama_customer,
                'no_telp' => $request->no_telp,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'pengguna_id' => auth()->user()->id
            ];

            if($request->hasFile('bukti_pembayaran')) {
                $bukti_pembayaran = $request->file('bukti_pembayaran');
                $fileName = str_replace(' ', '', $request->nama_customer) . '-' . time() . '.' . $bukti_pembayaran->getClientOriginalExtension();
                $savePath = 'assets/uploads/bukti-keluar';

                if(!file_exists($savePath)) {
                    mkdir($savePath, 655, true);
                }

                $bukti_pembayaran->move($savePath, $fileName);
                $data['bukti_pembayaran'] = $savePath . '/' . $fileName;
            }

            foreach (json_decode($request->list_produk, true)[0]['data'] as $key => $value) {
                $produk = Produk::find($value['produkId']);
                $produk->update([
                    'stok' => $produk->stok - (int)$value['jumlah']
                ]);
            }

            ProdukKeluar::create($data);

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
        $produk = ProdukKeluar::find($id);
        $view = [
            'data' => view('main.produk-keluar.edit', compact('produk'))->render(),
            'produk' => json_decode($produk->data, true)
        ];

        return response()->json($view);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        try {
            $produkKeluar = ProdukKeluar::find($request->produk_keluar_id);
            // dd($request->all());
            $data = [
                // 'supplier_id' => $request->supplier_id,
                'data' => json_encode(json_decode($request->list_produk, true)[0]['data']),
                'tanggal_proses' => date_format(date_create($request->tanggal_proses), 'Y-m-d'),
                'nama_customer' => $request->nama_customer,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'no_telp' => $request->no_telp,
                'pengguna_id' => auth()->user()->id
            ];

            if($request->hasFile('bukti_pembayaran')) {
                $bukti_pembayaran = $request->file('bukti_pembayaran');
                $fileName = str_replace(' ', '', $request->nama_customer) . '-' . time() . '.' . $bukti_pembayaran->getClientOriginalExtension();
                $savePath = 'assets/uploads/bukti-keluar';

                if(!file_exists($savePath)) {
                    mkdir($savePath, 655, true);
                }

                $bukti_pembayaran->move($savePath, $fileName);
                $data['bukti_pembayaran'] = $savePath . '/' . $fileName;
            }

            // update ++ stok
            foreach (json_decode($produkKeluar->data, true) as $key => $value) {
                $produk = Produk::find($value['produkId']);
                $produk->update([
                    'stok' => $produk->stok + (int)$value['jumlah']
                ]);
            }

            // update -- stok
            foreach (json_decode($request->list_produk, true)[0]['data'] as $key => $value) {
                $produk = Produk::find($value['produkId']);
                $produk->update([
                    'stok' => $produk->stok - (int)$value['jumlah']
                ]);
            }

            $produkKeluar->update($data);

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
        $produk = Produk::where('stok', '>', 0)
                        ->where('status', true)
                        ->get();

        return response()->json($produk);
    }

    public function dataKeluar($id) {
        $produkKeluar = ProdukKeluar::find($id);

        return response()->json(json_decode($produkKeluar->data, true));
    }

    public function print(Request $request)
    {
        $produk = ProdukKeluar::whereBetween('tanggal_proses', [$request->tanggal_awal, $request->tanggal_akhir])->get();

        $view = [
            'data' => view('main.produk-keluar.print', compact('produk'))->render(),
        ];

        return response()->json($view);
    }
}
