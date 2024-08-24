<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\ProdukKeluar;
use App\Models\ProdukMasuk;
use App\Models\ProdukRequest;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('main.laporan.index');
    }

    public function render(Request $request)
    {
        $kategori = $request->kategori;

        if($kategori == 'Produk Masuk') {
            $produk = ProdukMasuk::with(['supplier'])->whereBetween('tanggal_proses', [$request->tanggal_awal, $request->tanggal_akhir])->get();
            $page = 'main.laporan.render.produk-masuk';
        } elseif ($kategori == 'Produk Keluar') {
            $produk = ProdukKeluar::whereBetween('tanggal_proses', [$request->tanggal_awal, $request->tanggal_akhir])->get();
            $page = 'main.laporan.render.produk-keluar';
        } else {
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
            $page = 'main.laporan.render.produk-request';
        }

        $view = [
            'data' => view($page, compact('produk'))->render(),
        ];

        return response()->json($view);
    }

    public function print(Request $request)
    {
        $kategori = $request->kategori;

        if($kategori == 'Produk Masuk') {
            $produk = ProdukMasuk::with(['supplier'])->whereBetween('tanggal_proses', [$request->tanggal_awal, $request->tanggal_akhir])->get();
            $page = 'main.produk-masuk.print';
        } elseif ($kategori == 'Produk Keluar') {
            $produk = ProdukKeluar::whereBetween('tanggal_proses', [$request->tanggal_awal, $request->tanggal_akhir])->get();
            $page = 'main.produk-keluar.print';
        } else {
            if(auth()->user()->level == 'admin') {
                $produk = ProdukRequest::with(['staff'])
                            ->whereBetween('tanggal_request', [$request->tanggal_awal, $request->tanggal_akhir])
                            ->get();
            } else {
                $produk = ProdukRequest::with(['staff'])
                            ->where('pengguna_id', auth()->user()->id)
                            ->whereBetween('tanggal_request', [$request->tanggal_awal, $request->tanggal_akhir])
                            ->get();
                $page = 'main.produk-request.print';
            }
        }

        $view = [
            'data' => view($page, compact('produk'))->render(),
        ];

        return response()->json($view);
    }
}
