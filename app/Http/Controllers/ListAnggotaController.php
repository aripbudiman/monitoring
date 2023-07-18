<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;

class ListAnggotaController extends Controller
{
    public function index(){ 
        $anggota=Anggota::paginate(50);
        // $anggota=Anggota::all();
        return view('list-anggota',compact('anggota'));
    }


    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        foreach ($data as $row) {
            $namaAnggota = $row[0];
            $majelis = $row[1];
            $petugas = $row[2];

            $anggota=new Anggota();
            $anggota->nama_anggota=$namaAnggota;
            $anggota->majelis=$majelis;
            $anggota->petugas=$petugas;
            $anggota->save();
        }

        return redirect()->back()->with('success', 'Data berhasil diimpor dari file Excel.');
    }

    public function update_status(Anggota $status){ 
        $status->status='monitoring';
        $status->save();
        return back()->with('success','Anggota berhasil diupdate');
    }
}
