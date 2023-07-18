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
            $originalFilename = $uploadedFile->getClientOriginalName();
            $newFilename = $data['anggota'].'__'.$data['majelis'].'__'.$data['tanggal'] . '.' . $uploadedFile->getClientOriginalExtension();
            $data['dokumentasi'] = $uploadedFile->storeAs('public/dokumentasi', $newFilename);
            Monitoring::create($data);
        DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return redirect()->back()->with('success', 'Monitoring berhasil ditambahkan');
    }
}
