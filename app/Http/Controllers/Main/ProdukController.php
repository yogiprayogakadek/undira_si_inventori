<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('main.produk.index');
    }

    public function render()
    {
        $produk = Produk::all();

        $view = [
            'data' => view('main.produk.render', compact('produk'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $view = [
            'data' => view('main.produk.create')->render(),
        ];

        return response()->json($view);
    }

    public function store(ProdukRequest $request)
    {
        // dd($request->all());
        try {
            $produk = [
                'nama' => $request->nama,
                'stok' => $request->stok,
                // 'jenis' => $request->jenis,
                'keterangan' => $request->keterangan,
                'harga_beli' => preg_replace('/[^0-9]/', '', $request->harga_beli),
                'harga_jual' => preg_replace('/[^0-9]/', '', $request->harga_jual),
            ];

            if($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fileName = str_replace(' ', '', $request->nama) . '-' . time() . '.' . $foto->getClientOriginalExtension();
                $savePath = 'assets/uploads/produk';

                if(!file_exists($savePath)) {
                    mkdir($savePath, 655, true);
                }

                $foto->move($savePath, $fileName);
                $produk['foto'] = $savePath . '/' . $fileName;
            }

            Produk::create($produk);

            return redirect()->route('produk.index')->with([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                // 'message' => $e->getMessage(),
                'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        $view = [
            'data' => view('main.produk.edit', compact('produk'))->render(),
        ];

        return response()->json($view);
    }

    public function update(ProdukRequest $request)
    {
        // dd($request->all());
        try {
            $produk = Produk::find($request->id);

            $data = [
                'nama' => $request->nama,
                'stok' => $request->stok,
                // 'jenis' => $request->jenis,
                'keterangan' => $request->keterangan,
                'status' => $request->status,
                'harga_beli' => preg_replace('/[^0-9]/', '', $request->harga_beli),
                'harga_jual' => preg_replace('/[^0-9]/', '', $request->harga_jual),
            ];

            if($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fileName = str_replace(' ', '', $request->nama) . '-' . time() . '.' . $foto->getClientOriginalExtension();
                $savePath = 'assets/uploads/produk';

                if(!file_exists($savePath)) {
                    mkdir($savePath, 655, true);
                }

                $foto->move($savePath, $fileName);
                $data['foto'] = $savePath . '/' . $fileName;
            }

            $produk->update($data);

            return redirect()->route('produk.index')->with([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                // 'message' => $e->getMessage(),
                'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function print(Request $request) {
        $produk = Produk::all();

        $view = [
            'data' => view('main.produk.print', compact('produk'))->render(),
        ];

        return response()->json($view);
    }
}

