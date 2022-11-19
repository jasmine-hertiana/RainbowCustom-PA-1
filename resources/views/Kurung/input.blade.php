@extends('layouts.layout')

@section('content') 
<form action="{{route('kurung.store')}}" method="POST">
@csrf
    <fieldset>
        <div class="form-group row">
            <div class="col-md-5"> 
                Nomor Penyewaan<input id="notran" type="text" name="notrans" class="form-control" value="{{$nomor}}" required>
            </div>
            <div class="col-md-5"> 
                Nama Penyewa<input id="nama" type="text" name="nama" class="form-control" value="" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-5">
                Tanggal Sewa<input id="tglsewa" type="date" name="tglsewa" value=""class="form-control" required>
            </div>
            <div class="col-md-5">
                Tanggal Kembali<input id="tglkembali" type="date" name="tglkembali" value=""class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-5"> 
                NIK<input id="nik" type="text" name="nik" class="form-control" value="" required>
            </div>
            <div class="col-md-5"> 
                Nomor Telepon<input id="notelp" type="text" name="notelp" class="form-control" value="" required>
            </div>
        </div>
        <div class="form-group row"> 
            <div class="col-md-10">
                Memo<textarea id="memo" type="text" name="memo" class="form-control" required></textarea>
            </div>
            <div class="col-md-10">
                Alamat<textarea id="alamat" type="text" name="alamat" class="form-control" required></textarea>
            </div>
        </div>
        <div class="form-group row"> 
            <div class="col-md-4"> 
                Jumlah Sewa <input id="jmlsewa" type="text" name="jmlsewa" class="form-control" value="" required>
            </div> 
            <div class="col-md-10">
                Total Harga <input id="total" type="text" name="total" class="form-control" value="" required>
            </div>
        </div>
        <div class="form-group row">
        <div class="col-md-10">
            <input type="submit" class="btn btn-success btn-send" value="Simpan" >
            <input type="Button" class="btn btn-primary btn-send" value="Kembali" onclick="history.go(-1)">
        </div>
        </div><hr>
    </fieldset>
</form>
@endsection
