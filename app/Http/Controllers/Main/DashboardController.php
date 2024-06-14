<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Models\Pengguna;
use App\Models\ProdukKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('main.dashboard.index');
    }

    public function updateProfil(UpdateProfilRequest $request)
    {
        try {
            $pengguna = Pengguna::find(auth()->user()->id);


            // kemudian save ke table pegawai
            $pengguna->update([
                'nama' => $request->nama,
            ]);

            return redirect()->route('dashboard.index')->with([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data berhasil diubah.'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'title' => 'Gagal',
                'message' => $e->getMessage()
                // 'message' => 'Data pegawai gagal diubah.'
            ]);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $pengguna = Pengguna::where('id', auth()->user()->id)->first();

            if ($request->current_password != '') {
                if (!password_verify($request->current_password, $pengguna->password)) {
                    return redirect()->back()->with([
                        'status' => 'error',
                        'message' => 'Password lama tidak sesuai',
                        'title' => 'Gagal'
                    ]);
                }

                // Update password baru jika sudah benar
                $pengguna->update([
                    'password' => bcrypt($request->new_password)
                ]);
            }

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function chart(Request $request)
{
    $tanggal_awal = date_format(date_create($request->input('tanggal_awal')), 'Y-m-d');
    $tanggal_akhir = date_format(date_create($request->input('tanggal_akhir')), 'Y-m-d');

    $produkKeluar = ProdukKeluar::with(['pengguna'])->whereBetween('tanggal_proses', [$tanggal_awal, $tanggal_akhir])->get();

    $chartData = [];
    foreach ($produkKeluar as $keluar) {
        $penggunaNama = $keluar->pengguna->nama;
        foreach (json_decode($keluar->data, true) as $value) {
            if (!isset($chartData[$penggunaNama])) {
                $chartData[$penggunaNama] = 0;
            }
            $chartData[$penggunaNama] += $value['jumlah'];
        }
    }

    $formattedData = [];
    foreach ($chartData as $name => $value) {
        $formattedData[] = ['name' => $name, 'value' => $value];
    }

    return response()->json($formattedData);
}

}
