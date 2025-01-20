<?php

namespace App\Http\Controllers;

use App\Models\Input_aspirasi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class InputAspirasiController extends Controller
{
    public function index()
    {
        $aspirasis = Input_aspirasi::with('kategori')->get();
        return view ('inputaspirasi.index', compact('aspirasis'));
    }

    public function create()
    {
        return view ('inputaspirasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'=>'required',
            'kategori_id'=>'required',
            'lokasi' => 'required',
            'keterangan' => 'required',
            'foto' => 'required|mimes:png,jpeg,jpg'
        ]);
        $foto = $request->file('foto');
        $name = time().','.$foto->getClientOriginalExtension();
        $destinationPath = public_path('/foto');
        $foto->move($destinationPath, $name);
        if(Siswa::get()->where('nis', $request->nis)->count() >0 ){
        Input_aspirasi::create([
            'nis'=>$request->get('nis'),
            'lokasi'=>$request->get('lokasi'),
            'kategori_id'=>$request->get('kategori_id'),
            'keterangan'=>$request->get('keterangan'),
            'foto'=>$name,
        ]);
        return redirect()->back()->with('message', 'aspirasi berhasil dibuat');
    }else {
        Siswa::create([
            'nis'=>$request->get('nis'),
            'kelas'=>'blank',
        ]);

        Input_aspirasi::create([
            'nis'=>$request->get('nis'),
            'lokasi'=>$request->get('lokasi'),
            'kategori_id'=>$request->get('kategori_id'),
            'keterangan'=>$request->get('keterangan'),
            'foto'=>$name,
        ]);
        return redirect()->back()->with('message', 'Nis belum terdaftar, Harap hubungi Admin.');
    }
    }
    
    
}
