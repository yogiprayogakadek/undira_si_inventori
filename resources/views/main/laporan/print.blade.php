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
            <h3 class="text-center">Laporan Data Produk Keluar</h3>
        </div>
        <div class="col-12 mt-3">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Staff</th>
                    <th>Tanggal</th>
                    <th>Customer</th>
                    <th>No. Telp</th>
                    <th>Jenis Pembayaran</th>
                    <th>Data Produk</th>
                </thead>
                <tbody>
                    @foreach ($produk as $produk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $produk->pengguna->nama }}</td>
                            <td>{{ date_format(date_create($produk->tanggal_proses), 'd-m-Y') }}</td>
                            <td>{{ $produk->nama_customer }}</td>
                            <td>{{ $produk->no_telp }}</td>
                            <td>{{ ucfirst($produk->jenis_pembayaran) }}</td>
                            <td>
                                <div class="row">
                                    @foreach (json_decode($produk->data, true) as $item)
                                        <div class="col-6">Nama Produk</div>
                                        <div class="col-6">: {{ $item['namaProduk'] }}</div>
                                        <div class="col-6">Jumlah</div>
                                        <div class="col-6 mb-3">: {{ $item['jumlah'] }}</div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
