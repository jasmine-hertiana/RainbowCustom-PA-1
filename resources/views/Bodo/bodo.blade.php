@extends('layouts.layout')
@section('content') 
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Penyewaan</h1>
</div><hr>
<div>
    <img src="asset/img/bodo.jfif" width="300">
</div>
    <div class="card">
        <div class="card-body">
            Harga Sewa 1 Baju Adat Bodo = Rp.150.000/hari
        </div>     
    </div>
<div class="card-header py-3" align="right"> 
    <a href="{{route('bodo.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah </a>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr align="center">
                    <th width="20%">No Penyewaan</th>
                    <th width="15%">Tanggal Sewa</th>
                    <th width="15%">Tanggal Kembali</th>
                    <th width="15%">Jumlah Sewa</th>
                    <th width="15%">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bodo as $bd)
                <tr>
                    <td>{{$bd->nosw}}</td>
                    <td>{{$bd->tglsewa}}</td>
                    <td>{{$bd->tglkembali}}</td> 
                    <td>{{$bd->jmlsewa}}</td> 
                    <td>{{$bd->total}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
@endsection
