<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KurungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kr = \App\Kurung::All();
        return view( 'kurung.kurung' , ['kurung' => $kr]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AWAL = 'PR';
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = \App\Kurung::max('id');
        $nomorawal=$noUrutAkhir+1;
        $no = 1;
        if($noUrutAkhir) {
            //echo "No urut surat di database : " . $noUrutAkhir;
            //echo "<br>";
            $nomor=sprintf($AWAL . '-' ."%05s", abs($noUrutAkhir + 1));
        }
        else {
            //echo "No urut surat di database : 0" ;
            //echo "<br>";
            $nomor=sprintf($AWAL . '-' ."%05s", $no);
        }
        return view('kurung.input', ['nomor'=>$nomor,'nomorawal'=>$nomorawal,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Menyimpan Data Ke Tabel Jawi
        $save_kr = new \App\Kurung;
        $save_kr->nosw=$request->get('notrans');
        $save_kr->nama=$request->get('nama');
        $save_kr->nik=$request->get('nik');
        $save_kr->alamat=$request->get('alamat'); 
        $save_kr->notelp=$request->get('notelp');
        $save_kr->memo=$request->get('memo');
        $save_kr->tglsewa=$request->get('tglsewa');
        $save_kr->tglkembali=$request->get('tglkembali');
        $save_kr->jmlsewa=$request->get('jmlsewa');
        $save_kr->denda=0;
        $save_kr->total=$request->get('total');
        $save_kr->save(); 
 
        //Menyimpan Data Ke Tabel Kas_Masuk
        $save_km = new \App\KasMasuk;
        $save_km->nokm=$request->get('notrans');
        $save_km->tglkm=$request->get('tglsewa');
        $save_km->memokm=$request->get('memo');
        $save_km->jmkm=$request->get('total'); 
        $save_km->save(); 
 
        //Menyimpan Data Ke Tabel Buku_Besar
        $save_bb= new \App\BukuBesar;
        $save_bb->idtrans=$request->get('id');
        $save_bb->tgltran=$request->get('tglsewa');
        $save_bb->notran=$request->get('notrans');
        $save_bb->catatan=$request->get('memo');
        $save_bb->jmldb=$request->get('total');
        $save_bb->jmlcr=0;
        $save_bb->save();

        return redirect()->route( 'kurung.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}