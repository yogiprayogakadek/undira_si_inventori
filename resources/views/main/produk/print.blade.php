@extends('templates.master')

@section('content')
    <div class="row printableArea">
        <div class="col-6">
            <img src="{{ asset('assets/images/logo.png') }}" style="height: 100px !important; width: 140px !important;">
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    Nama Staff : {{ auth()->user()->nama }}
                </div>
                <div class="col-12">
                    Tanggal Laporan : {{ date('d-m-Y H:i:s') }}
                </div>
            </div>
        </div>
        <div class="col-12">
            <h3 class="text-center">Laporan Data Produk</h3>
        </div>
        <div class="col-12 mt-3">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    {{-- <th>Jenis Produk</th> --}}
                    <th>Keterangan</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @foreach ($produk as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ 'Rp ' . number_format($produk->harga_beli, 0, '.', '.') }}</td>
                            <td>{{ 'Rp ' . number_format($produk->harga_jual, 0, '.', '.') }}</td>
                            <td>{{ $produk->stok }}</td>
                            {{-- <td>{{ $produk->jenis }}</td> --}}
                            <td>{{ $produk->keterangan }}</td>
                            <td>{{ $produk->status == true ? 'Aktif' : 'Tidak Aktif' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
