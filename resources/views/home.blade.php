@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">HALLO {{ Auth::user()->name }} !! </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Selamat Datang, Kamu Lagi ada di Halaman Home nii
                </div>
            </div>
        </div>
    </div>
    <div>
        <img src="asset/img/baju_adat.png" width="500">
    </div>
</div>
@endsection

