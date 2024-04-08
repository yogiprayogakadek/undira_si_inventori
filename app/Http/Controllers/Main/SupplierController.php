<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('main.supplier.index');
    }

    public function render()
    {
        $supplier = Supplier::all();

        $view = [
            'data' => view('main.supplier.render', compact('supplier'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $view = [
            'data' => view('main.supplier.create')->render(),
        ];

        return response()->json($view);
    }

    public function store(SupplierRequest $request)
    {
        try {
            $supplier = [
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'telp' => $request->telp,
            ];

            Supplier::create($supplier);

            return redirect()->route('supplier.index')->with([
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
        $supplier = Supplier::find($id);
        $view = [
            'data' => view('main.supplier.edit', compact('supplier'))->render(),
        ];

        return response()->json($view);
    }

    public function update(SupplierRequest $request)
    {
        // dd($request->all());
        try {
            $supplier = Supplier::find($request->id);

            $data = [
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'telp' => $request->telp,
                'status' => $request->status,
            ];

            $supplier->update($data);

            return redirect()->route('supplier.index')->with([
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
}
