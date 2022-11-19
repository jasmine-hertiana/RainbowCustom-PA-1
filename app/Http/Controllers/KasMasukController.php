<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akun;
use App\BukuBesar;
use DB;
class KasMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $km = \App\KasMasuk::All();
        return view( 'kasmasuk.kasmasuk' , ['kasmasuk' => $km]);
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
        $AWAL = 'KM';
        // karna array dimulai dari 0 maka kita tambah di awal data kosong
        // bisa juga mulai dari "1"=>"I"
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = \App\KasMasuk::max('id');
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
        return view('kasmasuk.input', ['nomor'=>$nomor,'nomorawal'=>$nomorawal,'akun'=>$akun,'akn'=>$akun2]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Menyimpan Data Ke Tabel Kas_Masuk
        $save_km = new \App\KasMasuk;
        $save_km->nokm=$request->get('notrans');
        $save_km->tglkm=$request->get('tgltr');
        $save_km->memokm=$request->get('memo');
        $save_km->jmkm=$request->get('total'); 
        $save_km->save(); 
 
        //Menyimpan Data Ke Tabel Buku_Besar
        $save_bb= new \App\BukuBesar;
        $save_bb->idtrans=$request->get('idkm');
        $save_bb->tgltran=$request->get('tgltr');
        $save_bb->notran=$request->get('notrans');
        $save_bb->catatan=$request->get('memo');
        $save_bb->jmldb=$request->get('total');
        $save_bb->jmlcr=0;
        $save_bb->save();
 
        //Menyimpan Data Ke Tabel Kas_Masuk_det
        for($i=1;$i<=3;$i++) 
        {
            $idkm=$request->get('idkm');
            $idakn=$request->get('idakun'.$i);
            $nil=$request->get('txt'.$i);
            if($idakn==0 or $nil==0 or empty($idakn))
            {
                return redirect()->route( 'kasmasuk.index' );
            }
            else{
                $savedet = new \App\KasMasukDet;
                $savedet->idkm=$idkm;
                $savedet->idakun=$idakn;
                $savedet->nildb=$nil;
                $savedet->save();
            } 
        }
        return redirect()->route( 'kasmasuk.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $km = \App\KasMasuk::findOrFail($id);
        //Query Mengambil Data Detail
        $detail = DB::select('SELECT akun.kdakun, akun.nmakun,kas_masuk_det.nildb FROM kas_masuk_det, akun WHERE akun.id=kas_masuk_det.idakun AND idkm = :id', ['id' => $km->id]);
        return view( 'kasmasuk.detail' , ['kasmasuk' => $km, 'kasmasukdet' => $detail]);
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
        $km = \App\KasMasuk::findOrFail($id);
        $km->delete();
        DB::table('kas_masuk_det')->where('idkm','=',$km->id)->delete();
        DB::table('buku_besar')->where('notran','=', $km->nokm)->delete();
        return redirect()->route( 'kasmasuk.index');
    }
}
