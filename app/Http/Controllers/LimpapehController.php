<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LimpapehController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lp = \App\Limpapeh::All();
        return view( 'limpapeh.limpapeh' , ['limpapeh' => $lp]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AWAL = 'PL';
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = \App\Limpapeh::max('id');
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
        return view('limpapeh.input', ['nomor'=>$nomor,'nomorawal'=>$nomorawal,]);
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
        $save_lp = new \App\Limpapeh;
        $save_lp->nosw=$request->get('notrans');
        $save_lp->nama=$request->get('nama');
        $save_lp->nik=$request->get('nik');
        $save_lp->alamat=$request->get('alamat'); 
        $save_lp->notelp=$request->get('notelp');
        $save_lp->memo=$request->get('memo');
        $save_lp->tglsewa=$request->get('tglsewa');
        $save_lp->tglkembali=$request->get('tglkembali');
        $save_lp->jmlsewa=$request->get('jmlsewa');
        $save_lp->denda=0;
        $save_lp->total=$request->get('total');
        $save_lp->save(); 
 
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

        return redirect()->route( 'limpapeh.index' );
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
