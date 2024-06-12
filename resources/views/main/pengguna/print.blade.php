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
            <h3 class="text-center">Laporan Data Pengguna</h3>
        </div>
        <div class="col-12 mt-3">
            <table class="table table-hover table-striped" id="tableData">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @foreach ($pengguna as $pengguna)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengguna->nama }}</td>
                            <td>{{ $pengguna->username }}
                            </td>
                            <td>{{ $pengguna->level }}</td>
                            <td>{{ $pengguna->status == true ? 'Aktif' : 'Tidak Aktif' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
