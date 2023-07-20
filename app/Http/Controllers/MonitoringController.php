<?php

namespace App\Http\Controllers;

use App\Models\MonitoringAngsuran as Monitoring;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MonitoringController extends Controller
{
    public function index(){ 
        $data=Monitoring::all();
        return view('input-monitoring',compact('data'));
    }

    public function select_majelis(Request $request){
        $petugas = $request->petugas;
        $majelis = DB::table('anggota')
                ->select('majelis')
                ->where('petugas', $petugas)
                ->groupBy('majelis')
                ->get();
                $output = '';
        foreach ($majelis as $l) {
            $output .= '<option value="' . $l->majelis . '">' . $l->majelis. '</option>';
        }
        return response()->json($output);
    }

    public function select_anggota(Request $request){ 
        $majelis = $request->majelis;
        $anggota = DB::table('anggota')
                ->select('nama_anggota')
                ->where('majelis', $majelis)
                ->get();
                $output = '';
        foreach ($anggota as $a) {
            $output .= '<option value="' . $a->nama_anggota . '">' . $a->nama_anggota. '</option>';
        }
        return response()->json($output);
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $data = $request->all();
            $uploadedFile = $request->file('dokumentasi');
            $lastId = DB::table('monitoring_angsuran')->orderBy('id', 'desc')->first()->id;
            $newId = $lastId + 1;
            $newFilename = $newId.'__'.$data['anggota'].'__'.$data['majelis'].'__'.$data['tanggal'] . '.' . $uploadedFile->getClientOriginalExtension();
            $data['dokumentasi'] = $uploadedFile->storeAs('public/dokumentasi', $newFilename);
            Monitoring::create($data);
        DB::commit();
        } catch (\Throwable $th) {
            return with('error',$th);
            DB::rollBack();
        }
        return redirect()->back()->with('success', 'Monitoring berhasil ditambahkan');
    }

    public function edit(Monitoring $monitoring){
        return view('edit',compact('monitoring'));
    }

    public function update_dokumentasi(Request $request,Monitoring $monitoring){

        if($request->hasFile('dokumentasi')){
            $uploadedFile = $request->file('dokumentasi');
            $ext=$uploadedFile->getClientOriginalExtension();
            $nama=$monitoring->anggota;
            $majelis=$monitoring->majelis;
            $newNamaFoto=$monitoring->id.'__'.$nama.'__'.$majelis.'__'.$monitoring->tanggal.'.'.$ext;
            $monitoring->dokumentasi=$uploadedFile->storeAs('public/dokumentasi',$newNamaFoto);
            $monitoring->save();
            return redirect()->back();
        }else{
            $monitoring->dokumentasi=$monitoring->dokumentasi;
            $monitoring->save();
            return redirect()->back();
        }   
    }
}
