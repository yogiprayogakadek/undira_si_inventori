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
            <h3 class="text-center">Laporan Data Supplier</h3>
        </div>
        <div class="col-12 mt-3">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Telp</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @foreach ($supplier as $supplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $supplier->nama }}</td>
                            <td>{{ $supplier->tanggal }}
                            </td>
                            <td>{{ $supplier->telp }}</td>
                            <td>{{ $supplier->status == true ? 'Aktif' : 'Tidak Aktif' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
