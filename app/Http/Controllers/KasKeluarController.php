<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akun;
use App\BukuBesar;
use DB;
class KasKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kk = \App\KasKeluar::All();
        return view( 'kaskeluar.kaskeluar' , ['kaskeluar' => $kk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = \App\Akun::All();
        $akun2 = Akun::paginate(3);
 
        $AWAL = 'KK';
        // karna array dimulai dari 0 maka kita tambah di awal data kosong
        // bisa juga mulai dari "1"=>"I"
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = \App\kaskeluar::max('id');
        $nomorawal=$noUrutAkhir+1;
        $no = 1;
        if($noUrutAkhir) {
            //echo "No urut surat di database : " . $noUrutAkhir;
            //echo "<br>";
            $nomor=sprintf($AWAL . '-' ."%05s", abs($noUrutAkhir + 1));
        }
        else
        {
            //echo "No urut surat di database : 0" ;
            //echo "<br>";
            $nomor=sprintf($AWAL . '-' ."%05s", $no);
        }
        return view('kaskeluar.input', ['nomor'=>$nomor,'nomorawal'=>$nomorawal,'akun'=>$akun,'akn'=>$akun2]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Menyimpan Data Ke Tabel Kas_Keluar
        $save_kk = new \App\KasKeluar;
        $save_kk->nokk=$request->get('notrans');
        $save_kk->tglkk=$request->get('tgltr');
        $save_kk->memokk=$request->get('memo');
        $save_kk->jmkk=$request->get('total'); 
        $save_kk->save(); 
 
        //Menyimpan Data Ke Tabel Buku_Besar
        $save_bb= new \App\BukuBesar;
        $save_bb->idtrans=$request->get('idkk');
        $save_bb->tgltran=$request->get('tgltr');
        $save_bb->notran=$request->get('notrans');
        $save_bb->catatan=$request->get('memo');
        $save_bb->jmldb=0;
        $save_bb->jmlcr=$request->get('total');
        $save_bb->save();
 
        //Menyimpan Data Ke Tabel Kas_Keluar_det
        for($i=1;$i<=3;$i++) 
        {
            $idkk=$request->get('idkk');
            $idakn=$request->get('idakun'.$i);
            $nil=$request->get('txt'.$i);
            
            if($idakn==0 or $nil==0 or empty($idakn))
            {
                return redirect()->route( 'kaskeluar.index' );
            }
            else
            {
                $savedet = new \App\KasKeluarDet;
                $savedet->idkk=$idkk;
                $savedet->idakun=$idakn;
                $savedet->nilcr=$nil;
                $savedet->save();
            }  
        }
        return redirect()->route( 'kaskeluar.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kk = \App\KasKeluar::findOrFail($id);
        //Query Mengambil Data Detail
        $detail = DB::select('SELECT akun.kdakun, akun.nmakun,kas_keluar_det.nilcr FROM kas_keluar_det, akun WHERE akun.id=kas_keluar_det.idakun AND idkk = :id', ['id' => $kk->id]);
        return view( 'kaskeluar.detail' , ['kaskeluar' => $kk, 'kaskeluardet' => $detail]);
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
        $kk = \App\KasKeluar::findOrFail($id);
        $kk->delete();
        DB::table('kas_keluar_det')->where('idkk','=',$kk->id)->delete();
        DB::table('buku_besar')->where('notran','=', $kk->nokk)->delete();
        
        return redirect()->route( 'kaskeluar.index');

    }
}
