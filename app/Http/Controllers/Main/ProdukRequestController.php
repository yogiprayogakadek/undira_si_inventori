<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\ProdukRequest;
use Illuminate\Http\Request;

class ProdukRequestController extends Controller
{
    public function index()
    {
        return view('main.produk-request.index');
    }

    public function render()
    {
        if(auth()->user()->level == 'admin') {
            $produk = ProdukRequest::with(['staff'])->get();
        } else {
            $produk = ProdukRequest::with(['staff'])->where('pengguna_id', auth()->user()->id)->get();
        }
        $view = [
            'data' => view('main.produk-request.render', compact('produk'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $view = [
            'data' => view('main.produk-request.create')->render(),
        ];

        return response()->json($view);
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'pengguna_id' => auth()->user()->id,
                'data' => json_encode(json_decode($request->list_produk, true)[0]['data']),
                'tanggal_request' => date_format(date_create($request->tanggal_request), 'Y-m-d'),
            ];

            ProdukRequest::create($data);

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
        $produk = ProdukRequest::find($id);
        $view = [
            'data' => view('main.produk-request.edit', compact(['produk']))->render(),
            'produk' => json_decode($produk->data, true)
        ];

        return response()->json($view);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        try {
            $produkRequest = ProdukRequest::find($request->produk_request_id);
            // dd($request->all());
            $data = [
                'data' => json_encode(json_decode($request->list_produk, true)[0]['data']),
                'tanggal_request' => date_format(date_create($request->tanggal_request), 'Y-m-d'),
            ];

            $produkRequest->update($data);

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

    public function dataRequest($id) {
        $produkRequest = ProdukRequest::find($id);

        return response()->json(json_decode($produkRequest->data, true));
    }

    public function updateStatus(Request $request)
    {
        // dd($request->all());
        try {
            $produkRequest = ProdukRequest::find($request->id);
            // dd($produkRequest);
            $produkRequest->update([
                'status' => $request->status
            ]);

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

    public function print(Request $request) {
        if(auth()->user()->level == 'admin') {
            $produk = ProdukRequest::with(['staff'])
                        ->whereBetween('tanggal_request', [$request->tanggal_awal, $request->tanggal_akhir])
                        ->get();
        } else {
            $produk = ProdukRequest::with(['staff'])
                        ->where('pengguna_id', auth()->user()->id)
                        ->whereBetween('tanggal_request', [$request->tanggal_awal, $request->tanggal_akhir])
                        ->get();
        }

        $view = [
            'data' => view('main.produk-request.print', compact('produk'))->render(),
        ];

        return response()->json($view);
    }
}
