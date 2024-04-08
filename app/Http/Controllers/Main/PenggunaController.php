<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenggunaRequest;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    protected function defaultPassword()
    {
        return '12345678';
    }

    protected function defaultPath()
    {
        return 'assets/uploads/users/default.png';
    }

    public function index()
    {
        return view('main.pengguna.index');
    }

    public function render()
    {
        $pengguna = Pengguna::all();

        $view = [
            'data' => view('main.pengguna.render', compact('pengguna'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $view = [
            'data' => view('main.pengguna.create')->render(),
        ];

        return response()->json($view);
    }

    public function store(PenggunaRequest $request)
    {
        try {
            $pengguna = [
                'nama' => $request->nama,
                'username' => $request->username,
                'level' => 'staff',
                'password' => Hash::make($this->defaultPassword()),
            ];

            Pengguna::create($pengguna);

            return redirect()->route('pengguna.index')->with([
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
        $pengguna = Pengguna::find($id);
        $view = [
            'data' => view('main.pengguna.edit', compact('pengguna'))->render(),
        ];

        return response()->json($view);
    }

    public function update(PenggunaRequest $request)
    {
        // dd($request->all());
        try {
            $pengguna = Pengguna::find($request->id);

            $data = [
                'nama' => $request->nama,
                'username' => $request->username,
                'status' => $request->status,
            ];

            $pengguna->update($data);

            return redirect()->route('pengguna.index')->with([
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
